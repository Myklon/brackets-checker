[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)
![Packagist Version](https://img.shields.io/packagist/v/myklon/brackets-checker)

A simple library for validating balanced brackets in a string

## Installation
The recommended way to install this library is [through Composer](https://getcomposer.org).

This will install the latest supported version:
```php
composer require myklon/brackets-checker
```
## Usage
```php
use Myklon\BracketsChecker\BracketsChecker;

$checkBrackets = new BracketsChecker();

$checkBrackets->getAvailableBrackets();  // return string with available brackets
$checkBrackets->check("[1 * (2 + 3)]");  // return true
$checkBrackets->baseString;     // return base string [1 * (2 + 3)]
$checkBrackets->validString;    // return cleared string [()]
```