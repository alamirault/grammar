# Overview

This package allows you to write Grammar in PHP OOP.

#Installation

Install PHP grammar parser using [Composer](https://getcomposer.org/download/):

```bash
composer require alamirault/grammar
```

Or add the package to your `composer.json`

```json
require: {
    // ...
    "alamirault/grammar": "~1.0" // check packagist.org for more tags
    // ...
}
```

# Usage

## Simple example

```php
$floatMarker = new OrOperator(
    new Constant(","),
    new Constant(".")
);

$digit = new Pattern("[0-9]");
$digits = new Repeat($digit);

$float = new AndOperator($digits, $floatMarker, $digits);

$grammar = new Grammar('Float', [
    new Definition("Float", $float),
]);

dump($grammar->parse("12.34"));

Alamirault\Grammar\Result {#11
  -value: "12.34"
  -length: 5
  -offset: 0
  -match: true
}

```

## More complex example

```php
$oneSpace = new Constant(' ');
$spaces = new Repeat($oneSpace);

$action = new OrOperator(
    new Constant("ALLOW"),
    new Constant("REFUSE")
);

$if = new Constant("if");

$userType = new Constant("userType");

$userTypeValues = new OrOperator(
    new Constant("WRITER"),
    new Constant("ACTOR")
);

$leftParenthesis = new Constant('(');
$rightParenthesis = new Constant(')');

$comma = new Constant(',');
$arrayElements = new AndOperator(
    new Repeat(
        new OrOperator(
            $spaces,
            new AndOperator($userTypeValues, $comma)
        )
    ),
    $userTypeValues
);


$in = new OrOperator(
    new Constant('in'),
    new Constant('IN')
);

$rule = new AndOperator($action, $spaces, $if, $spaces, $userType, $spaces, $in, $spaces, $leftParenthesis, $arrayElements, $rightParenthesis);

$grammar = new Grammar('Rule1', [
    new Definition("Rule1", $rule),
]);


dump($grammar->parse("ALLOW if userType in (WRITER, ACTOR)")); will return 

Alamirault\Grammar\Result {#26
  -value: "ALLOW if userType in (WRITER, ACTOR)"
  -length: 36
  -offset: 0
  -match: true
}

```

## Extending package with your own types: example of list

# Running the test suits
```php
./vendor/bin/phpunit
```

# License
The project is released under the BSD-3 Clause license. For the full copyright and license information, please view the LICENSE file that was distributed with this source code.

# Contributing
If you want to contribute to a project and make it better, your help is very welcome.