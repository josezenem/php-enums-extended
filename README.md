# PHP 8.1 Enums Extended

[![Latest Stable Version](http://poser.pugx.org/josezenem/php-enums-extended/v)](https://packagist.org/packages/josezenem/php-enums-extended)
[![Tests](https://github.com/josezenem/php-enums-extended/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/josezenem/php-enums-extended/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/josezenem/php-enums-extended.svg?style=flat-square)](https://packagist.org/packages/josezenem/php-enums-extended)
[![PHP Version Require](http://poser.pugx.org/josezenem/php-enums-extended/require/php)](https://packagist.org/packages/josezenem/php-enums-extended)

PHP 8.1 Enums Extended, gives you the ability to use additional methods to work with PHP 8.1 Enums.

## Installation

You can install the package via composer:

```bash
composer require josezenem/php-enums-extended
```

## Usage

* **->equals(...$params)** Pass one or multiple parameters, will return true if one matches.
* **->doesNotEqual(...$params)** Inverse of ->equals()


* **::toOptionsArray()** Will return an array of a $key => $val pair.
* **::toOptionsInverseArray()** Will return an array of a $val => $key pair.

```php

// Blog.php
class Blog
{
    public function __construct(
        public StatusEnum $status = StatusEnum::Open,
    ) {
    }
}

// StatusEnum.php
use Josezenem\PhpEnumsExtended\Traits\PhpEnumsExtendedTrait;

enum StatusEnum:int
{
    use PhpEnumsExtendedTrait;

    case Closed = 0;
    case Open = 1;
    case Draft = 2;
}



// Usage
$blog = new Blog();


// ->equals()
$blog->status->equals(StatusEnum::Open); // will return true if it matches
$blog->status->equals(StatusEnum::Closed, StatusEnum::Open); // Pass any number of params, will return true if it matches any of the parameters

// ->doesNotEqual()
$blog->status->doesNotEqual(StatusEnum::Closed); // will return true if it does not match
$blog->status->doesNotEqual(StatusEnum::Closed, StatusEnum::Draft)  // Pass any number of params, will return true if it does not match any of the parameters



// ::toOptionsArray()
$options = StatusEnum::toOptionsArray();

// will output
//$options = [
//    0 => 'Closed',
//    1 => 'Open',
//    2 => 'Closed',
//];



// ::toOptionsInverseArray()
$options = StatusEnum::toOptionsInversedArray();

// will output
//$options = [
//    'Closed' => 0,
//    'Open' => 1,
//    'Closed' => 2,
//];

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
- Special thanks to [Spatie](https://spatie.be) & [Brendt](https://stitcher.io) for their packages and knowledge.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
