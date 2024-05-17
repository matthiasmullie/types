<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Double;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class DoubleTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Double();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not a double: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not a double: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not a double: null'),
            ],
            [
                '123',
                123.0,
            ],
            [
                123,
                123.0,
            ],
            [
                'a',
                new InvalidArgumentException('Not a double: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not a double: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not a double: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not a double: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not a double: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not a double: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not a double: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not a double: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not a double: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not a double: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not a double: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not a double: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not a double: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not a double: {"a":"b","c":"x"}'),
            ],
            [
                1,
                1.0,
            ],
            [
                0,
                0.0,
            ],
            [
                true,
                1.0,
            ],
            [
                '1',
                1.0,
            ],
            [
                'off',
                new InvalidArgumentException('Not a double: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not a double: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not a double: "test@example.com"'),
            ],
            [
                '123.456',
                123.456,
            ],
            [
                123.456,
                123.456,
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not a double: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not a double: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not a double: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not a double: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not a double: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not a double: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not a double: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not a double: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not a double: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not a double: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not a double: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not a double: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
