<?php
/**	op-unit-validate:/ci/Validate/_RegExp.php
 *
 * @created    2026-02-15 by Codex CLI
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

//	Resolve method name from this file name.
$method = basename(__FILE__);
$method = explode('.', $method)[0];

/* @var $ci \OP\UNIT\CI\CI_Config */

//	...
$result = ['test','test'];
$args   = ['test','integer'];
$ci->Set($method, $result, $args);

//	Built-in rule: non-integer characters should be captured.
$result = ['abc', 'abc'];
$args   = ['abc', 'integer'];
$ci->Set($method, $result, $args);

//	Built-in rule: integer-only value should pass with no match.
$result = false;
$args   = ['12345', 'integer'];
$ci->Set($method, $result, $args);

//	Custom pattern with "/" delimiter should work.
$result = ['ABC', 'ABC'];
$args   = ['ABC', '/([A-Z]+)/'];
$ci->Set($method, $result, $args);

//	Custom pattern with "#" delimiter should be rejected.
$result = 'Notice: Only \'/\' delimiter is allowed. (#([A-Z]+)#)';
$args   = ['ABC', '#([A-Z]+)#'];
$ci->Set($method, $result, $args);

//	Pattern with missing closing "/" should be rejected.
$result = 'Notice: Closing \'/\' delimiter is missing. (/([a-z]+)';
$args   = ['abc', '/([a-z]+'];
$ci->Set($method, $result, $args);

//	Escaped "/" inside pattern body should be accepted.
$result = ['a/b', 'a/b'];
$args   = ['a/b', '/(a\\/b)/'];
$ci->Set($method, $result, $args);

//	Unescaped "/" inside pattern body should be rejected.
$result = 'Notice: Escape error. (/(a/b)/)';
$args   = ['a/b', '/(a/b)/'];
$ci->Set($method, $result, $args);
