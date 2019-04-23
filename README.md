# PHP Grammar parser

This package allows you to write Grammar in PHP OOP.

#Installation

Install PHP grammar parser using [Composer](https://getcomposer.org/download/):

```bash
$ composer require alamirault/grammar
```

# Usage


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

#licence

#contributing