<?php
/**	op-unit-validate:/ci/Validate/SplitComma.php
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
$result = [
	'min(1)',
	'max(10)',
	'short(1)',
	'long(10)',
	'regex(/\w/)',
	'regexp(/\w/)',
	'english',
	'username',
];
$args   = ['min(1), max(10), short(1), long(10), regex(/\w/), regexp(/\w/), english, username'];
$ci->Set($method, $result, $args);
