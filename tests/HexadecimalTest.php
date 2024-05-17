<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Hexadecimal;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class HexadecimalTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Hexadecimal();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not hexadecimal: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not hexadecimal: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not hexadecimal: null'),
            ],
            [
                '123',
                '123',
            ],
            [
                123,
                '123',
            ],
            [
                'a',
                'a',
            ],
            [
                'test',
                new InvalidArgumentException('Not hexadecimal: "test"'),
            ],
            [
                'abc',
                'abc',
            ],
            [
                'not valid',
                new InvalidArgumentException('Not hexadecimal: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not hexadecimal: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not hexadecimal: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not hexadecimal: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not hexadecimal: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not hexadecimal: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not hexadecimal: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not hexadecimal: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not hexadecimal: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not hexadecimal: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not hexadecimal: {"a":"b","c":"x"}'),
            ],
            [
                1,
                '1',
            ],
            [
                0,
                '0',
            ],
            [
                true,
                new InvalidArgumentException('Not hexadecimal: true'),
            ],
            [
                '1',
                '1',
            ],
            [
                'off',
                new InvalidArgumentException('Not hexadecimal: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not hexadecimal: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not hexadecimal: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not hexadecimal: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not hexadecimal: 123.456'),
            ],
            [
                '00ff00',
                '00ff00',
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                '01234567890abcdef01234567890abcdef01234',
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                '01234567890abcdef01234567890abcdef012345',
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                '01234567890abcdef01234567890abcdef0123456',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not hexadecimal: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not hexadecimal: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not hexadecimal: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not hexadecimal: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not hexadecimal: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
