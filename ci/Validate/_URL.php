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
$result =  false;
$args   = ['http://example.co.jp'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['http://example.com'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com/'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com/path'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com/path/'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com/path/plus'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com/path/plus/index.php'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com/path/plus/index.html'];
$ci->Set($method, $result, $args);

//	...
$result =  false;
$args   = ['https://example.com/path/plus/index.html?q=1'];
$ci->Set($method, $result, $args);

//	...
$result =  true;
$args   = ['example.com/path'];
$ci->Set($method, $result, $args);
