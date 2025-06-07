<?php
/** op-unit-validate:/ci/Validate.php
 *
 * @created    2024-05-09
 * @version    1.0
 * @package    op-unit-validate
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	...
$ci = OP::Unit('CI')::Config();

//	Template
$meta_path = \OP\RootPath('asset').'unit/validate/template/ci.txt';
$method = 'Template';
$args   = 'ci.txt';
$result = "Notice: This file is not located in the template directory: `{$meta_path}`";
$ci->Set($method, $result, $args);

//	...
$method = '_Email';
$result =  false;
$args   = ['root@localhost'];
$ci->Set($method, $result, $args);

//	...
$method = '_Email';
$result = '@';
$args   = ['root'];
$ci->Set($method, $result, $args);

//	...
$method = '_Email';
$result =  true;
$args   = ['@localhost'];
$ci->Set($method, $result, $args);

//	...
$method = '_Phone';
$result =  null;
$args   = ['090-0000-0000'];
$ci->Set($method, $result, $args);

//	...
$method = '_RegExp';
$result = ['test','test'];
$args   = ['test','integer'];
$ci->Set($method, $result, $args);

//	...
$method = '_Required';
$result =  false;
$args   = ['test'];
$ci->Set($method, $result, $args);

//	...
$method = '_ParseString';
$result = ['max'=>10];
$args   = ['max(10)'];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$method = 'Evaluations';
$result =  true;
$args   = [
	['integer','ascii'],
	['1234567890','abcdefg'],
	$errors,
];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$method = 'Evaluation';
$result =  false;
$args   = [
	'required',
	'',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
return $ci->Get();
