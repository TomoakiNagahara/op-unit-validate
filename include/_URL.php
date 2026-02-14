<?php
/**	op-unit-validate:/include/_URL.php
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

//	Allow empty values when the rule is used without `required`.
if( $value === '' ){
	return false;
}

//	Validate as an absolute URL.
if(!filter_var($value, FILTER_VALIDATE_URL) ){
	return true;
}

//	Split URL into components for additional checks.
$parsed = parse_url($value);

//	A URL must include scheme.
if( empty($parsed['scheme']) ){
	return 'scheme';
}

//	A URL must include host.
if( empty($parsed['host']) ){
	return 'host';
}

//	Restrict scheme to HTTP(S) only.
$scheme = strtolower($parsed['scheme']);
if(!in_array($scheme, ['http','https'], true) ){
	return $scheme;
}

//	Validation passed.
return false;
