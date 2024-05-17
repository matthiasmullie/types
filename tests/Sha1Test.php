<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Sha1;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class Sha1Test extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Sha1();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not sha1: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not sha1: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not sha1: null'),
            ],
            [
                '123',
                new InvalidArgumentException('Not sha1: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not sha1: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not sha1: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not sha1: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not sha1: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not sha1: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not sha1: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not sha1: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not sha1: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not sha1: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not sha1: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not sha1: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not sha1: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not sha1: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not sha1: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not sha1: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not sha1: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not sha1: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not sha1: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not sha1: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not sha1: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not sha1: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not sha1: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not sha1: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not sha1: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not sha1: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not sha1: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                '01234567890abcdef01234567890abcdef012345',
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not sha1: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not sha1: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not sha1: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not sha1: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not sha1: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not sha1: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not sha1: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not sha1: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not sha1: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
