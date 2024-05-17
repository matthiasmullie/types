<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Enum;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class EnumTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Enum(['this', 'is', 'a', 'test', 123, ...AnEnum::cases()]);
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                AnEnum::One,
            ],
            [
                AnEnum::Two,
                AnEnum::Two,
            ],
            [
                null,
                new InvalidArgumentException('Not a valid enum value: null'),
            ],
            [
                '123',
                new InvalidArgumentException('Not a valid enum value: "123"'),
            ],
            [
                123,
                123,
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
                new InvalidArgumentException('Not a valid enum value: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not a valid enum value: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not a valid enum value: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not a valid enum value: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not a valid enum value: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not a valid enum value: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not a valid enum value: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not a valid enum value: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not a valid enum value: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not a valid enum value: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not a valid enum value: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not a valid enum value: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not a valid enum value: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not a valid enum value: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not a valid enum value: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not a valid enum value: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not a valid enum value: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not a valid enum value: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not a valid enum value: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not a valid enum value: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not a valid enum value: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not a valid enum value: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not a valid enum value: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not a valid enum value: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not a valid enum value: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not a valid enum value: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not a valid enum value: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not a valid enum value: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not a valid enum value: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not a valid enum value: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not a valid enum value: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not a valid enum value: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not a valid enum value: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
