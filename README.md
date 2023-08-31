# relaxed json

[![packagist](http://poser.pugx.org/8ctopus/relaxed-json/v)](https://packagist.org/packages/8ctopus/relaxed-json)
[![downloads](http://poser.pugx.org/8ctopus/relaxed-json/downloads)](https://packagist.org/packages/8ctopus/relaxed-json)
[![min php version](http://poser.pugx.org/8ctopus/relaxed-json/require/php)](https://packagist.org/packages/8ctopus/relaxed-json)
[![license](http://poser.pugx.org/8ctopus/relaxed-json/license)](https://packagist.org/packages/8ctopus/relaxed-json)
[![tests](https://github.com/8ctopus/relaxed-json/actions/workflows/tests.yml/badge.svg)](https://github.com/8ctopus/relaxed-json/actions/workflows/tests.yml)
![code coverage badge](https://raw.githubusercontent.com/8ctopus/relaxed-json/image-data/coverage.svg)
![lines of code](https://raw.githubusercontent.com/8ctopus/relaxed-json/image-data/lines.svg)

Tired of JSON's super strict syntax? Then relaxed JSON if for you.

## features

- supports comments in all forms `// my comment`, `/* my comment */`
- ignores trailing commas at the end of an array or object
- throws an Exception when the json is invalid
- zero dependencies

## install

    composer require 8ctopus/relaxed-json

## usage

```php
$json = <<<JSON
{
    // maximum requests per hour
    "throttleThreshold": 300,
}

JSON;

var_dump(RelaxedJson::decode($json, true));
```

```txt
array(1) {
  'name' =>
  string(20) "8ctopus/relaxed-json"
}
```

### exceptions

```php
$json = <<<JSON
{
    "throttleThreshold" => 300,
}

JSON;

// throws RelaxedJsonException Syntax error
RelaxedJson::decode($json, true);
```

## credits

This library is are repack with improvements of the original work from [https://github.com/etconsilium/php-json-fix](https://github.com/etconsilium/php-json-fix)

## tests

    composer test

## clean code

    composer fix
    composer fix-risky
