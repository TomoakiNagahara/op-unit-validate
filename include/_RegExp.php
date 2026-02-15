<?php
/**	op-unit-validate:/include/_RegExp.php
 *
 * @created    2026-02-15
 * @license    Apache-2.0
 * @package    op-unit-validate
 * @copyright  Tomoaki Nagahara
 */

/**	Declare strict type
 *
 */
declare(strict_types=1);

/**	Namespace
 *
 */
namespace OP;

/* @var $value string */
/* @var $which string */

switch( strtolower($which) ){
	//	Match non-integer characters.
	case 'integer':
		$eval = '/([^-0-9]+)/';
		break;

	//	Match non-ASCII printable characters.
	case 'ascii':
	case 'english':
		$eval = '/([^\x09\x0a\x0d\x20-\x7E]+)/';
		break;

	//	Match non-alphabetic characters.
	case 'alphabet':
		$eval = '/([^a-z]+)/i';
		break;

	//	Match non-alphanumeric characters.
	case 'alphanumeric':
		$eval = '/([^0-9a-z]+)/i';
		break;

	//	Can be used for user name validation.
	case 'username':
		$eval = '/([^ _a-zA-Z0-9,\.\-\'"`@]+)/u';
		break;

	//	Can be used for password validation.
	case 'password':
		$eval = '/([^\x21-\x7E])/u';
		break;

	//	Match non-kana characters.
	case 'kana':
		$eval = '/([^\p{Hiragana}\p{Katakana}]+)/';
		break;

	//	Match non-hiragana characters.
	case 'hiragana': // hiragana only
		$eval = '/([^\p{Hiragana}]+)/';
		break;

	//	Match non-katakana characters.
	case 'katakana': // zenkaku katakana
		$eval = '/([^\p{Katakana}]+)/';
		break;

	//	Match non-hankaku characters.
	case 'hankaku': // hankaku
		$eval = '/([^ｱ-ﾝ_0-9a-zA-Z]+)/';
		break;

	//	Match ASCII characters in zenkaku-only mode.
	case 'zenkaku':
		$eval = '/([\x09\x0a\x0d\x20-\x7E]+)/';
		break;

	//	Match non-Han characters.
	case 'kanji': // Kanji character
	case 'cjkv': // China, Japan, Korea, Vietnam
	case 'han':
		$eval = '/([^\p{Han}]+)/';
		break;

	//	Alternative Chinese block-specific rule.
	case 'chinese':
		$eval = '/([^\p{In_CJK_Unified_Ideographs}]+)/';
		break;

	//	Match non-Base58 characters.
	case 'base58': // For bitcoin address. Bitcoin use 0? regtest only?
		$eval = '/([^123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz]+)/';
		break;

	//	Treat `$which` as raw regular expression.
	default:
		$eval = $which;
		break;
}

//	Require "/" as the regular expression delimiter.
if( ($eval[0] ?? null) !== '/' ){
	OP()->Notice("Only '/' delimiter is allowed. ($eval)");
	return false;
}

//	Find closing delimiter.
$len = strrpos($eval, '/');
if( $len === false or $len === 0 ){
	OP()->Notice("Closing '/' delimiter is missing. ($eval)");
	return false;
}

//	Check that unescaped "/" is not used inside the pattern body.
for( $i=0; $i<$len; $i++ ){
	if( $i = strpos($eval, '/', $i) ){
		if( $i < $len and $eval[$i-1] !== '\\' ){
			OP()->Notice("Escape error. ($eval)");
		//	$error[$key] = true;
			return false;
		}
	}
}

//	Initialize match result.
$m = false;

//	Execute regular expression with UTF-8 mode.
if(!preg_match("{$eval}u", $value, $m) ){
	$m = false;
}

//	Return full match result or false when no match.
return $m;
