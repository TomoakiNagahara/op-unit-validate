<?php
/**	op-unit-validate:/include/_Email.php
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

//	Do not allow alias names.
if( strpos($value, '+') !== false ){
	return '+';
}

//	Check that "@" exists.
if(($pos = strpos($value, '@')) === false ){
	return '@';
}

//	Split local-part and domain.
$addr = substr($value, 0, $pos);
/*
$host = substr($value, $pos + 1);
*/

//	Local-part must not be empty.
if( empty($addr) ){
	return true;
}

//	Allow only limited characters in local-part.
$m = null;
if( preg_match('/([^-\._0-9a-z]+)/i', $addr, $m) ){
	return $m[1];
}

//	Optional DNS checks (currently disabled).
/*
if( $host !== 'gmail.com' ){
	if(!checkdnsrr($host,'MX') ){
		return $host;
	}
}
*/

/*
//	Check that domain resolves.
if(!gethostbynamel($host) ){
	return $host;
}
*/

//	Validation passed.
return false;
