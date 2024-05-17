<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Sha512;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class Sha512Test extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Sha512();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not sha512: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not sha512: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not sha512: null'),
            ],
            [
                '123',
                new InvalidArgumentException('Not sha512: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not sha512: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not sha512: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not sha512: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not sha512: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not sha512: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not sha512: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not sha512: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not sha512: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not sha512: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not sha512: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not sha512: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not sha512: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not sha512: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not sha512: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not sha512: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not sha512: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not sha512: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not sha512: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not sha512: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not sha512: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not sha512: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not sha512: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not sha512: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not sha512: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not sha512: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not sha512: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not sha512: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not sha512: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not sha512: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not sha512: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not sha512: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not sha512: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not sha512: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not sha512: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not sha512: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
