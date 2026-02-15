<?php
/**	op-unit-validate:/include/_Required.php
 *
 * @created    2026-02-16
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

//	...
if( is_int($value) ){
	return false;
}

//	...
if( is_string($value) ){
	$value = trim($value);
	return strlen($value) ? false : true ;
}

//	...
if( is_array($value) ){
	return empty($value);
}

//	...
return false;
