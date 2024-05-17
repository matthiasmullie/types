# Types

[![Build status](https://img.shields.io/github/actions/workflow/status/matthiasmullie/types/test.yml?branch=main&style=flat-square)](https://github.com/matthiasmullie/types/actions/workflows/test.yml)
[![Code coverage](https://img.shields.io/codecov/c/gh/matthiasmullie/types?style=flat-square)](https://codecov.io/gh/matthiasmullie/types)
[![Latest version](https://img.shields.io/packagist/v/matthiasmullie/types?style=flat-square)](https://packagist.org/packages/matthiasmullie/types)
[![Downloads total](https://img.shields.io/packagist/dt/matthiasmullie/types?style=flat-square)](https://packagist.org/packages/matthiasmullie/types)
[![License](https://img.shields.io/packagist/l/matthiasmullie/types?style=flat-square)](https://github.com/matthiasmullie/types/blob/main/LICENSE)


## Installation

Simply add a dependency on `matthiasmullie/types` to your composer.json file if you use [Composer](https://getcomposer.org/) to manage the dependencies of your project:

```sh
composer require matthiasmullie/types
```


## Usage

```php
use MatthiasMullie\Types;

$type = new Types\Json(
    new Types\Map([
        'user_id' => new Types\Sha1(
            description: 'Unique user id',
        ),
        'email' => new Types\Email(
            description: 'Email address of the user',
        ),
        'gender' => new Types\Enum(
            ['m', 'f'],
            description: 'Biological sex',
        ),
        'birthdate' => new Types\Optional(
            new Types\Integer(),
            description: 'Birth date, UNIX timestamp',
        ),
    ]),
);
```

```php
// this will succeed because the input is valid;
// `birthdate`, given as a string, will be cast to an integer
$safeInput = $type([
    'user_id' => 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd4',
    'email' => 'jane.doe@example',
    'gender' => 'f',
    'birthdate' => '1715950172',
]);
```

```php
// this will throw an exception because a required field (`gender`)
// is missing; note: `$type->test(...)` can also be used to simply
// check validity instead
$safeInput = $type([
    'user_id' => 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd4',
    'email' => 'jane.doe@example',
    'birthdate' => '1715950172',
]);
```

```php
// this will throw an exception because the input for `email` is not
// a valid email address
$safeInput = $type([
    'user_id' => 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd4',
    'email' => 'not an email address',
    'gender' => 'f',
    'birthdate' => '1715950172',
]);
```


## License

types is [MIT](http://opensource.org/licenses/MIT) licensed.
