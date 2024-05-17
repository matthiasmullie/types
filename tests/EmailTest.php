<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Email;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class EmailTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Email();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not an email: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not an email: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not an email: null'),
            ],
            [
                '123',
                new InvalidArgumentException('Not an email: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not an email: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not an email: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not an email: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not an email: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not an email: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not an email: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not an email: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not an email: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not an email: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not an email: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not an email: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not an email: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not an email: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not an email: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not an email: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not an email: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not an email: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not an email: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not an email: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not an email: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not an email: ""'),
            ],
            [
                'test@example.com',
                'test@example.com',
            ],
            [
                '123.456',
                new InvalidArgumentException('Not an email: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not an email: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not an email: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not an email: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not an email: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not an email: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not an email: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not an email: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not an email: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not an email: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not an email: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not an email: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not an email: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not an email: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
