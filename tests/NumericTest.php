<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Numeric;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class NumericTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Numeric();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not numeric: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not numeric: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not numeric: null'),
            ],
            [
                '123',
                123,
            ],
            [
                123,
                123,
            ],
            [
                'a',
                new InvalidArgumentException('Not numeric: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not numeric: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not numeric: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not numeric: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not numeric: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not numeric: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not numeric: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not numeric: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not numeric: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not numeric: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not numeric: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not numeric: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not numeric: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not numeric: {"a":"b","c":"x"}'),
            ],
            [
                1,
                1,
            ],
            [
                0,
                0,
            ],
            [
                true,
                1,
            ],
            [
                '1',
                1,
            ],
            [
                'off',
                new InvalidArgumentException('Not numeric: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not numeric: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not numeric: "test@example.com"'),
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
                new InvalidArgumentException('Not numeric: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not numeric: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not numeric: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not numeric: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not numeric: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not numeric: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not numeric: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not numeric: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not numeric: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not numeric: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not numeric: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not numeric: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
