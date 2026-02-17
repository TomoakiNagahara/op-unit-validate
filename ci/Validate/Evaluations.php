<?php
/**	op-unit-validate:/ci/Validate/Evaluations.php
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
$result =  true;
$args   = [
	['integer','ascii'],
	['1234567890','abcdefg'],
	$errors,
];
$ci->Set($method, $result, $args);
