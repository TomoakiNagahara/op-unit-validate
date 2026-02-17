<?php
/**	op-unit-validate:/Validate.class.php
 *
 * @created   2017-01-31
 * @license   Apache-2.0
 * @package   op-unit-validate
 * @copyright Tomoaki Nagahara
 */

/**	Namespace
 *
 * @created   2018-01-22
 */
namespace OP\UNIT;

/**	Use
 *
 */
use OP\OP_CORE;
use OP\OP_UNIT;
use OP\IF_UNIT;
use OP\IF_VALIDATE;

/**	Validate
 *
 * @created   2017-01-31
 */
class Validate implements IF_UNIT, IF_VALIDATE
{
	/** trait
	 *
	 */
	use OP_CORE, OP_UNIT;
	use \OP\OP_CI;

	/** EMail
	 *
	 * @param  string  $value
	 * @return boolean|string $failed
	 */
	static private function _Email(string $value)
	{
		return include(__DIR__.'/include/_Email.php');
	}

	/** Phone
	 *
	 * @param  string $source
	 * @return boolean
	 */
	static private function _Phone(string $value)
	{
		$m = null;
		if( preg_match('/[^-0-9\.\+\ )]/i', $value, $m) ){
			return true;
		}
	}

	/**	_URL
	 *
	 * @created   2026-02-15 by Codex CLI
	 * @param     string         $value
	 * @return    boolean|string $failed
	 */
	static private function _URL( string $value )
	{
		return include(__DIR__.'/include/_URL.php');
	}

	/** Regular Expression
	 *
	 * @see		 https://msdn.microsoft.com/ja-jp/library/20bw873z.aspx
	 * @see		 https://fossies.org/linux/www/php-7.2.5.tar.xz/php-7.2.5/ext/mbstring/oniguruma/doc/UNICODE_PROPERTIES
	 * @param	 string $value
	 * @param	 string $which
	 * @return	 boolean|string $result
	 */
	static private function _RegExp($value, $which)
	{
		return include(__DIR__.'/include/_RegExp.php');
	}

	/** Required
	 *
	 * @param  string|array $source
	 * @return boolean
	 */
	static private function _Required($value)
	{
		return include(__DIR__.'/include/_Required.php');
	}

	static function _ParseString($strings)
	{
		//	...
		$config = [];

		//	...
		foreach( explode(',', $strings) as $string ){
			if( $st  = strpos($string, '(') and
				$en  = strpos($string, ')') ){
				$val = substr($string, $st +1, $en - $st -1);
				$key = substr($string, 0, $st);
				$val = is_numeric($val) ? (int)$val: trim($val);
			}else{
				$key = $string;
				$val = true;
			}

			//	...
			$config[trim($key)] = $val;
		}

		//	...
		return $config;
	}

	/** Evaluations
	 *
	 * @param  array   $configs Validate configuration.
	 * @param  array   $values  Evaluation value.
	 * @param  array   $errors  Errors
	 * @return boolean $io      True is successful.
	 */
	static function Evaluations($configs, $values, &$errors)
	{
		//	...
		$failed = null;

		//	...
		if( is_string($configs) ){
			if( file_exists($configs) ){
				$configs = include($configs);
			}else{
				Notice::Set("Has not been exists this file. ($configs)");
			}
		}

		//	...
		foreach( $configs as $key => $config ){
			if(!self::Evaluation($config, $values[$key] ?? null, $errors[$key], $values) ){
				$failed = true;
			}
		}

		//	...
		return $failed ? false: true;
	}

	/** Evaluate each value.
	 *
	 * @param  string  $rule
	 * @param  array   $value
	 * @param  array   $error
	 * @param  array   $values
	 * @return boolean $fail
	 */
	static function Evaluation($rule, $value, &$error, $values=null)
	{
		/*	Disbled for URL, Regex, Email
		//	...
		$rule  = OP()->Encode($rule);
		$value = OP()->Encode($value);
		*/

		//	...
		$failed = null;

		//	...
		if( is_string($rule) ){
			$rule = self::_ParseString($rule);
		}

		//	...
		foreach( $rule as $key => $eval ){
			switch( $key ){
				case '':
					break;

				case 'required':
					if(!$eval ){
						$failed = false;
					}else
					if( $error[$key] = self::_Required($value) ){
						$failed = true;
						break 2;
					}
					break;

				case 'number':
					if( $len = mb_strlen($value) ){
						$error[$key] = !is_numeric($value);
					}else{
						$error[$key] = false;
					}
					break;

				case 'integer':
				case 'ascii':
				case 'english':
				case 'alphabet':
				case 'alphanumeric':
				case 'username':
				case 'password':
				case 'han':
				case 'kana':
				case 'hiragana':
				case 'katakana':
				case 'hankaku':
				case 'zenkaku':
				case 'chinese':
				case 'base58':
					if( $regexp = self::_RegExp($value, $key) ){
						$regexp = $regexp[1];
					}
					$error[$key] = $regexp;
					break;

				case 'regex':
				case 'regexp':
					$error[$key] = self::_RegExp($value, $eval);
					break;

				case 'mail':
				case 'email':
				case 'mail-addr':
					$error[$key] = self::_Email($value);
					break;

				case 'phone':
					$error[$key] = self::_Phone($value);
					break;

				case 'url':
					$error[$key] = self::_URL($value);
					break;

				case 'short':
					$len = mb_strlen($value);
					if( $len === 0 ){
						$error[$key] = false;
					}else{
						$error[$key] = ($len < $eval) ? $eval - mb_strlen($value): false;
					}
					break;

				case 'long':
					$error[$key] = (mb_strlen($value) > $eval) ? mb_strlen($value) - $eval: false;
					break;

				case 'min':
				case 'max':
				case 'positive':
				case 'negative':
					if( strlen($value) === 0 ){
						$io = false;
					}else if( ! is_numeric($value) ){
						$io = true;
						$key= 'numeric';
					}else if( $key === 'min' ){
						$io = ($value < $eval) ? ($eval - $value): false;
					}else if( $key === 'max' ){
						$io = ($value > $eval) ? ($value - $eval): false;
					}else if( $key === 'positive' ){
						$io = $value <= 0 ? true: false;
					}else if( $key === 'negative' ){
						$io = $value >= 0 ? true: false;
					}
					$error[$key] = $io;
					break;

				case 'if':
					if(!$io = is_string($values[$eval]) ? $values[$eval]: join('', ifset($values[$eval], [])) ){
						break 2;
					}
					break;

				/** The "confirm" is compare the values of the two inputs
				 *  It is used, for example, to confirm the password entered during registration.
				 */
				case 'confirm':
					$error[$key] = !($value === $values[$eval]);
					break;

				default:
					OP()->Notice("This validation is not defined: `{$key}`");
					$failed = true;
			}

			//	...
			if(!$failed and $error[$key] ?? null ){
				$failed = true;
			}
		}

		//	...
		return $failed ? false: true;
	}
}
