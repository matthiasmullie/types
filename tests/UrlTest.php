<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;
use MatthiasMullie\Types\Url;

class UrlTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Url();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not a url: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not a url: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not a url: null'),
            ],
            [
                '123',
                new InvalidArgumentException('Not a url: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not a url: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not a url: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not a url: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not a url: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not a url: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not a url: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not a url: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not a url: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not a url: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not a url: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not a url: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not a url: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not a url: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not a url: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not a url: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not a url: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not a url: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not a url: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not a url: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not a url: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not a url: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not a url: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not a url: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not a url: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not a url: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not a url: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not a url: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not a url: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not a url: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not a url: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not a url: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not a url: "www.mullie.eu"'),
            ],
            [
                'http://www.mullie.eu',
                'http://www.mullie.eu',
            ],
            [
                'http://www.mullie.eu:80',
                'http://www.mullie.eu:80',
            ],
            [
                'http://www.mullie.eu:80?code=123',
                'http://www.mullie.eu:80?code=123',
            ],
            [
                'http://www.mullie.eu:80?code=123&redirect_uri=',
                'http://www.mullie.eu:80?code=123&redirect_uri=',
            ],
            [
                [10, 200],
                new InvalidArgumentException('Not a url: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not a url: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not a url: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not a url: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
