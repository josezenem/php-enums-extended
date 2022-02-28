# PHP 8.1 Enums Extended

[![Latest Stable Version](http://poser.pugx.org/josezenem/php-enums-extended/v)](https://packagist.org/packages/josezenem/php-enums-extended)
[![Tests](https://github.com/josezenem/php-enums-extended/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/josezenem/php-enums-extended/actions/workflows/run-tests.yml)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/0bd2399747f045e78039e72d51a87355)](https://www.codacy.com/gh/josezenem/php-enums-extended/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=josezenem/php-enums-extended&amp;utm_campaign=Badge_Grade)
[![Total Downloads](https://img.shields.io/packagist/dt/josezenem/php-enums-extended.svg?style=flat-square)](https://packagist.org/packages/josezenem/php-enums-extended)
[![PHP Version Require](http://poser.pugx.org/josezenem/php-enums-extended/require/php)](https://packagist.org/packages/josezenem/php-enums-extended)

PHP 8.1 Enums Extended, gives you the ability to use additional methods to work with PHP 8.1 Enums.

```php
enum StatusEnum:int
{
    case Closed = 0;
    case Open = 1;
    case PENDING_APPROVAL = 2;
}

// Given a new Blog() that uses the enum trait, you can do things like:
$blog->status->isOpen() // Will return boolean
$blog->status->equals(StatusEnum::Open, StatusEnum::Closed)

// Normalization happens in the background allowing these scenarios 
$blog->status->isPendingApproval();
$blog->status->isPENDING_APPROVAL();

StatusEnum::Open() // Will return ->value, vs doing StatusEnum::Open->value
StatusEum::PendingApproval()
StatusEum::PENDING_APPROVAL()
```

## Installation

You can install the package via composer:

```bash
composer require josezenem/php-enums-extended
```

## Usage
* **->equals(...$params)** Pass one or multiple parameters, will return true if one matches.
* **->doesNotEqual(...$params)** Inverse of ->equals()


* **::options()** Will return an array of a $key => $val pair.
* **::optionsFlipped()** Will return an array of a $val => $key pair.

```php

// StatusEnum.php
// StatusEnum:int is used for the example, but supports :string and default of just StatusEnum
use Josezenem\PhpEnumsExtended\Traits\PhpEnumsExtendedTrait;

enum StatusEnum:int
{
    use PhpEnumsExtendedTrait;

    case Closed = 0;
    case Open = 1;
    case Draft = 2;
}

// Blog.php
class Blog
{
    public function __construct(
        public StatusEnum $status = StatusEnum::Open,
    ) {
    }
}



// Usage
$blog = new Blog();


// ->equals()
$blog->status->equals(StatusEnum::Open); // will return true if it matches
$blog->status->equals(StatusEnum::Closed, StatusEnum::Open); // Pass any number of params, will return true if it matches any of the parameters

// ->doesNotEqual()
$blog->status->doesNotEqual(StatusEnum::Closed); // will return true if it does not match
$blog->status->doesNotEqual(StatusEnum::Closed, StatusEnum::Draft)  // Pass any number of params, will return true if it does not match any of the parameters

// ->is** magic method
// the magic method takes camelCase allowing you to do boolean check against any field.
$blog->status->isOpen() // will return true or false

// ::options()
$options = StatusEnum::options();

// will output
//$options = [
//    0 => 'Closed',
//    1 => 'Open',
//    2 => 'Closed',
//];

// ::optionsFlipped()
$options = StatusEnum::optionsFlipped();

// will output
//$options = [
//    'Closed' => 0,
//    'Open' => 1,
//    'Closed' => 2,
//];
```

<a name="available-methods"></a>
## [`Available Methods`](#available-methods)

- [`equals()`](#method-equals)
- [`doesNotEqual()`](#method-does-not-equal)
- [`isCall**()`](#method-isCall)

<a name="available-static-methods"></a>
## [`Available Static Methods`](#available-static-methods)
- [`options()`](#static-method-to-options-array)
- [`optionsFlipped()`](#static-method-to-options-flipped-array)
- [`names()`](#static-method-to-names-array)
- [`values()`](#static-method-to-values-array)
- [`call**()`](#static-method-call)

<a name="method-equals"></a>
### `equals()`
Pass one or multiple Enum cases, will return boolean if one matches.
```php
$blog->status->equals(StatusEnum::Closed, StatusEnum::Draft);
```
<a name="method-does-not-equal"></a>
### `doesNotEqual()`
Pass one or multiple Enum cases, will return boolean if it does not match.
```php
$blog->status->doesNotEqual(StatusEnum::Closed, StatusEnum::Draft);
```
<a name="method-is"></a>
### `isCall**()`
Returns boolean if the current value matches the desired case.  Methods with underscores can be accessed via camel case, as well as their regular name.
```php
$blog->status->isDraft();

// Given StatusEnum::OPEN_ISSUE = 4;
// the following is acceptable.
$blog->status->isOpenIssue();
$blog->status->isOPEN_ISSUE();
```
<a name="static-method-to-options-array"></a>
### `options()`
Will return an array of $val => $key.
```php
$options = self::options()

// returns
$options = [
    'open' => 'Open',
    'closed' => 'Closed',
    'draft' => 'Draft',
]
```
<a name="static-method-to-options-flipped-array"></a>
### `optionsFlipped()`
Will return an array of $key => $val.
```php
$options = self::optionsFlipped()

// returns
$options = [
    'Open' => 'open',
    'Closed' => 'closed',
    'Draft' => 'draft',
]
```
<a name="static-method-to-names-array"></a>
### `names()`
Will return an array of only names
```php
$options = self::names()

// returns
$options = [
    'Open' => 'Open',
    'Closed' => 'Closed',
    'Draft' => 'Draft',
]
```
<a name="static-method-to-values-array"></a>
### `values()`
Will return an array of only values
```php
$options = self::values()

// returns
$options = [
    'open' => 'open',
    'closed' => 'closed',
    'draft' => 'draft',
]
```

<a name="static-method-call"></a>
### `call**()`
Will allow you to grab the value of a field by calling it statically.
```php
// Consider the following scenario, to get the value you would do:
// StatusEnum::Open->value
enum StatusEnum:int
{
    case Closed = 0;
    case Open = 1;
    case Draft = 2;
}

// You can instead get value directy by calling it statically
// Case Insensitive
StatusEnum::OPEN()
StatusEnum::Open()
```

### Exception Handler
When using the magic methods, if the method calls do not exist, the system will throw

```
Josezenem\PhpEnumsExtended\Exceptions\EnumsExtendedException
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jose Jimenez](https://github.com/josezenem)
- [All Contributors](../../contributors)
- Special Thanks to [Shocm](https://twitter.com/shocm) for pushing me to make this, and answering my late replies.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
