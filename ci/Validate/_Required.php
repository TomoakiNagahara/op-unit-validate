<?php
/**	op-unit-validate:/ci/Validate/_Required.php
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

//	...
$method = basename(__FILE__);
$method = explode('.', $method)[0];

/* @var $ci \OP\UNIT\CI\CI_Config */

//	...
$result =  false;
$args   = ['test'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['0'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = [0];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = [' '];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = ["\t"];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = ["\r"];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = ["\n"];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = ["\v"];
$ci->Set($method, $result, $args);
