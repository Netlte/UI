# Netlte > UI

[![Build Status](https://img.shields.io/travis/com/Netlte/UI.svg?style=flat-square)](https://travis-ci.com/Netlte/UI)
[![Licence](https://img.shields.io/packagist/l/Netlte/UI.svg?style=flat-square)](https://packagist.org/packages/Netlte/UI)
[![Downloads this Month](https://img.shields.io/packagist/dm/Netlte/UI.svg?style=flat-square)](https://packagist.org/packages/Netlte/UI)
[![Downloads total](https://img.shields.io/packagist/dt/Netlte/UI.svg?style=flat-square)](https://packagist.org/packages/Netlte/UI)
[![Latest stable](https://img.shields.io/packagist/v/Netlte/UI.svg?style=flat-square)](https://packagist.org/packages/Netlte/UI)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

## Credits

Feel free to use. Your contributions are very welcome. Feel free to publish pull requests.

## Overview

UI helpers and abstract classes user across of organization

## Install

```
composer require netlte/ui
```

## Versions

| State       | Version | Branch   | PHP      |
|-------------|---------|----------|----------|
| stable      | `^1.0`  | `master` | `>= 7.4` |
| NoN         | `^2.0`  | `master` | `>= 8.0` |


## Tests

Check code quality and run tests
```
composer update --dev
composer build
```

or separately

```
composer update --dev
composer cs
composer analyse
composer tests
```

## Example usage
```php
// use factory to create CEB instance
// factory creates and registers file readers and generators so you don't have to do it manually
$options = new Options('path/to/bccert.pem', 'certPassPhrase', 'contractId', 'appGuid');
$factory = new CEBFactory($options, '/tmp/dir/path');
$ceb = $factory->create();

// returns API response with files listed in CEB API
$list = $ceb->listFiles();
Assert::count(2, $list->getFiles());

// You can read and parse files content

// first one is VYPIS type
$as = $ceb->downloadAndRead($list->getFiles()[0]);
Assert::true($as instanceof IReport);
// You can iterate entries and get details about each transaction
Assert::count(11, $as->getEntries());

// second one is AVIZO type
$adv = $ceb->downloadAndRead($list->getFiles()[1]);
Assert::true($adv instanceof IAdvice);
// You can iterate entries and get details about each transaction
Assert::count(3, $adv->getTransactions());

// generate and upload payment batch file to CEB
$payments = []; // create list of IPaymentOrder entities eg by: new InlandPayment(...)
$file = $ceb->generatePaymentFile($payments);
$ceb->upload([$file]);
```

## Authors

| [Tomáš Holan](https://github.com/holantomas)                             |
|--------------------------------------------------------------------------|
| ![Latest stable](https://avatars3.githubusercontent.com/u/5030499?s=100) |


