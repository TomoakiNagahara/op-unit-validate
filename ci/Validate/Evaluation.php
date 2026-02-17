<?php
/**	op-unit-validate:/ci/Validate/Evaluation.php
 *
 * @created    2026-02-17
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

//	...
$method = basename(__FILE__);
$method = explode('.', $method)[0];

/* @var $ci \OP\UNIT\CI\CI_Config */

//	...
$errors = null;
$result = false;
$args   = [
	'required',
	'',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$result = true;
$args   = [
	'url',
	'https://example.com/',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$result = true;
$args   = [
	'email',
	'root@localhost',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$result = false;
$args   = [
	'url',
	'example.com/path',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$result = false;
$args   = [
	'email',
	'root+alias@localhost',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$result = 'Exception: Format error: regex(#([A-Z]+)#)';
$args   = [
	'regex(#([A-Z]+)#)',
	'ABC',
	$errors,
];
$ci->Set($method, $result, $args);
