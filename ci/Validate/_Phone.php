<?php
/**	op-unit-validate:/ci/Validate/_URL.php
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

//	...
$method = basename(__FILE__);
$method = explode('.', $method)[0];

/* @var $ci \OP\UNIT\CI\CI_Config */

//	...
$result =  null;
$args   = ['090-0000-0000'];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = ['090-0000-0000@'];
$ci->Set($method, $result, $args);
