# Bag

[![Build Status](https://travis-ci.org/railken/bag.svg?branch=master)](https://travis-ci.org/railken/bag)
[![Maintainability](https://api.codeclimate.com/v1/badges/6f62d8c43195d612be0c/maintainability)](https://codeclimate.com/github/railken/bag/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/6f62d8c43195d612be0c/test_coverage)](https://codeclimate.com/github/railken/bag/test_coverage)
[![Style CI](https://styleci.io/repos/103975718/shield?branch=master)](https://styleci.io/repos/103975718)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Latest stable](https://img.shields.io/packagist/v/railken/bag.svg?style=flat-square)](https://packagist.org/packages/railken/bag)
[![PHP](https://img.shields.io/travis/php-v/railken/bag.svg)](https://secure.php.net/)

Inspired by [ParameterBag](https://github.com/symfony/http-foundation/blob/master/ParameterBag.php) I decided to create a new repository that contains a similiar class with a few adjustments.


## Requirements

PHP 8.1 or later.

## Composer

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/bag
```


## Getting Started

Simple usage looks like:

```php

use Railken\Bag;

# Initialization
$bag = new Bag();
$bag = new Bag(['foo' => '1']);

# Setting
$bag->set('foo', 1)->set('fee', 2);

# Getting
$bag->foo; #1
$bag->get('bar', 3); #3
 
```

## License

Open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
