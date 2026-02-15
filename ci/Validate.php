<?php
/**	op-unit-validate:/ci/Validate.php
 *
 * @created    2024-05-09
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
$ci = OP()->Unit()->CI()->Config();

//	Include sub directory files.
$name = basename(__FILE__);
$name = explode('.', $name)[0];
foreach( glob(__DIR__."/{$name}/*.php") as $path ){
	require_once($path);
}

//	Template
$meta_path = \OP\RootPath('asset').'unit/validate/template/ci.txt';
$method = 'Template';
$args   = 'ci.txt';
$result = "Notice: This file is not located in the template directory: `{$meta_path}`";
$ci->Set($method, $result, $args);

//	...
$method = '_Phone';
$result =  null;
$args   = ['090-0000-0000'];
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
$errors = null;
$method = 'Evaluation';
$result =  true;
$args   = [
	'url',
	'https://example.com/',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
$errors = null;
$method = 'Evaluation';
$result =  true;
$args   = [
	'email',
	'root@localhost',
	$errors,
];
$ci->Set($method, $result, $args);

//	...
return $ci->Get();
