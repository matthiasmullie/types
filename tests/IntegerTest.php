<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Integer;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class IntegerTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Integer();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not an integer: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not an integer: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not an integer: null'),
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
                new InvalidArgumentException('Not an integer: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not an integer: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not an integer: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not an integer: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not an integer: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not an integer: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not an integer: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not an integer: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not an integer: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not an integer: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not an integer: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not an integer: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not an integer: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not an integer: {"a":"b","c":"x"}'),
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
                new InvalidArgumentException('Not an integer: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not an integer: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not an integer: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not an integer: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not an integer: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not an integer: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not an integer: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not an integer: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not an integer: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not an integer: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not an integer: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not an integer: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not an integer: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not an integer: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not an integer: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not an integer: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not an integer: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
