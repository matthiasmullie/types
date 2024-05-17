<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;
use MatthiasMullie\Types\Undefined;

class UndefinedTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Undefined();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not undefined: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not undefined: "two"'),
            ],
            [
                null,
                null,
            ],
            [
                '123',
                new InvalidArgumentException('Not undefined: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not undefined: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not undefined: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not undefined: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not undefined: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not undefined: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not undefined: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not undefined: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not undefined: [["test"]]'),
            ],
            [
                [],
                null,
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not undefined: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not undefined: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not undefined: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not undefined: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not undefined: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not undefined: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not undefined: 1'),
            ],
            [
                0,
                null,
            ],
            [
                true,
                new InvalidArgumentException('Not undefined: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not undefined: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not undefined: "off"'),
            ],
            [
                '',
                null,
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not undefined: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not undefined: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not undefined: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not undefined: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not undefined: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not undefined: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not undefined: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not undefined: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not undefined: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not undefined: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not undefined: "www.mullie.eu"'),
            ],
            [
                'http://www.mullie.eu',
                new InvalidArgumentException('Not undefined: "http:\/\/www.mullie.eu"'),
            ],
            [
                'http://www.mullie.eu:80',
                new InvalidArgumentException('Not undefined: "http:\/\/www.mullie.eu:80"'),
            ],
            [
                'http://www.mullie.eu:80?code=123',
                new InvalidArgumentException('Not undefined: "http:\/\/www.mullie.eu:80?code=123"'),
            ],
            [
                'http://www.mullie.eu:80?code=123&redirect_uri=',
                new InvalidArgumentException('Not undefined: "http:\/\/www.mullie.eu:80?code=123&redirect_uri="'),
            ],
            [
                [10, 200],
                new InvalidArgumentException('Not undefined: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not undefined: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not undefined: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not undefined: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
