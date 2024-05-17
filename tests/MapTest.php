<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Enum;
use MatthiasMullie\Types\Map;
use MatthiasMullie\Types\Optional;
use MatthiasMullie\Types\Text;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class MapTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Map([
            'a' => new Text(),
            'c' => new Optional(new Enum(['b', 'a', 'd'])),
        ]);
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not a map: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not a map: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not a map: null'),
            ],
            [
                '123',
                new InvalidArgumentException('Not a map: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not a map: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not a map: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not a map: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not a map: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not a map: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Invalid a. Not text: null'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Invalid a. Not text: null'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Invalid a. Not text: null'),
            ],
            [
                [],
                new InvalidArgumentException('Invalid a. Not text: null'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not a map: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not a map: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                ['a' => 'b'],
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                ['a' => 'b', 'c' => 'd'],
            ],
            [
                ['a' => 'b', 'c' => null],
                ['a' => 'b', 'c' => null],
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Invalid c. Not a valid enum value: "x"'),
            ],
            [
                1,
                new InvalidArgumentException('Not a map: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not a map: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not a map: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not a map: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not a map: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not a map: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not a map: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not a map: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not a map: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not a map: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not a map: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not a map: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not a map: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not a map: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not a map: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not a map: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not a map: "www.mullie.eu"'),
            ],
            [
                'http://www.mullie.eu',
                new InvalidArgumentException('http:\/\/www.mullie.eu'),
            ],
            [
                'http://www.mullie.eu:80',
                new InvalidArgumentException('http:\/\/www.mullie.eu:80'),
            ],
            [
                'http://www.mullie.eu:80?code=123',
                new InvalidArgumentException('http:\/\/www.mullie.eu:80?code=123'),
            ],
            [
                'http://www.mullie.eu:80?code=123&redirect_uri=',
                new InvalidArgumentException('http:\/\/www.mullie.eu:80?code=123&redirect_uri='),
            ],
            [
                [10, 200],
                new InvalidArgumentException('Invalid a. Not text: null'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Invalid a. Not text: null'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not a map: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not a map: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
