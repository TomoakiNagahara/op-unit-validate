Unit of Validate
===

# Usage

A unit usage.

```
<?php
/* @var $validate \OP\UNIT\Validate */
$validate = OP()->Unit('validate');

//	...
$result = $validate->Evaluation('required', $value);
```

Call from Form unit.

```php
//  ...
$form = [
  'name' => 'example',
];
$form['Input'][] = [
  'name' => 'text',
  'type' => 'text',
  'rule' => 'required, number, min(0), max(10)',
  'errors' => [
    'required' => 'This is error: $label, $rule, $name, $value',
  ],
];
//  ...
OP()->Form()->Config($form);
//  ...
OP()->Form()->Validate();
```

# Rule

## Number

 * Integer
 * Float
 * Positive
 * Negative
 * min
 * max

## String

 * short
 * long
 * alphabet
 * number
 * alphanumeric
 * english
 * email
 * url
 * domain
 * phone
