<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;
use MatthiasMullie\Types\UrlEncoded;

class UrlEncodedTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new UrlEncoded();
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
                new InvalidArgumentException('Not url encoded: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not url encoded: null'),
            ],
            [
                '123',
                '123',
            ],
            [
                123,
                new InvalidArgumentException('Not url encoded: 123'),
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
                new InvalidArgumentException('Not url encoded: "not valid'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not url encoded: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not url encoded: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not url encoded: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not url encoded: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not url encoded: "[\"a\",\"b\"]"'),
                '%5B%22a%22%2C%22b%22%5D',
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not url encoded: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not url encoded: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not url encoded: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not url encoded: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not url encoded: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not url encoded: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not url encoded: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not url encoded: true'),
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
                '',
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not url encoded: "test@example.com"'),
            ],
            [
                '123.456',
                '123.456',
            ],
            [
                123.456,
                new InvalidArgumentException('Not url encoded: 123.456'),
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
                'www.mullie.eu',
            ],
            [
                'http://www.mullie.eu',
                new InvalidArgumentException('Not url encoded: "http:\/\/www.mullie.eu"'),
            ],
            [
                'http://www.mullie.eu:80',
                new InvalidArgumentException('Not url encoded: "http:\/\/www.mullie.eu:80"'),
            ],
            [
                'http://www.mullie.eu:80?code=123',
                new InvalidArgumentException('Not url encoded: "http:\/\/www.mullie.eu:80?code=123"'),
            ],
            [
                'http://www.mullie.eu:80?code=123&redirect_uri=',
                new InvalidArgumentException('Not url encoded: "http:\/\/www.mullie.eu:80?code=123&redirect_uri="'),
            ],
            [
                [10, 200],
                new InvalidArgumentException('Not url encoded: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not url encoded: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not url encoded: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
            ],
        ];
    }
}
