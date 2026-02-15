<?php
/**	op-unit-validate:/ci/Validate/_Email.php
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

/* @var $ci \OP\UNIT\CI\CI_Config */

//	...
$method = basename(__FILE__);
$method = explode('.', $method)[0];

//	...
$result =  false;
$args   = ['root@localhost'];
$ci->Set($method, $result, $args);

//	...
$result = '@';
$args   = ['root'];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = ['@localhost'];
$ci->Set($method, $result, $args);

//	...
$result = '+';
$args   = ['root+alias@localhost'];
$ci->Set($method, $result, $args);

//	...
$result = '!';
$args   = ['root!name@localhost'];
$ci->Set($method, $result, $args);
