<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Alphanumeric;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class AlphanumericTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Alphanumeric();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                'one',
            ],
            [
                AnEnum::Two,
                'two',
            ],
            [
                null,
                new InvalidArgumentException('Not alphanumeric: null'),
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
                'test',
            ],
            [
                'abc',
                'abc',
            ],
            [
                'not valid',
                new InvalidArgumentException('Not alphanumeric: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not alphanumeric: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not alphanumeric: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not alphanumeric: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not alphanumeric: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not alphanumeric: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not alphanumeric: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not alphanumeric: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not alphanumeric: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not alphanumeric: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not alphanumeric: {"a":"b","c":"x"}'),
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
                new InvalidArgumentException('Not alphanumeric: true'),
            ],
            [
                '1',
                '1',
            ],
            [
                'off',
                'off',
            ],
            [
                '',
                new InvalidArgumentException('Not alphanumeric: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not alphanumeric: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not alphanumeric: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not alphanumeric: 123.456'),
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
                new InvalidArgumentException('Not alphanumeric: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not alphanumeric: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not alphanumeric: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not alphanumeric: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not alphanumeric: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
