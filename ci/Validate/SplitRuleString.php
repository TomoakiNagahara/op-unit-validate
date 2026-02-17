<?php
/**	op-unit-validate:/ci/Validate/SplitRuleString.php
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
$result = ['min'=>1];
$args   = ['min(1)'];
$ci->Set($method, $result, $args);

//	...
$result = ['max'=>10];
$args   = ['max(10)'];
$ci->Set($method, $result, $args);

//	...
$result = ['short'=>1];
$args   = ['short(1)'];
$ci->Set($method, $result, $args);

//	...
$result = ['long'=>10];
$args   = ['long(10)'];
$ci->Set($method, $result, $args);
