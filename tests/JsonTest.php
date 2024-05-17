<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Json;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class JsonTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Json();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not JSON: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not JSON: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not JSON: null'),
            ],
            [
                '123',
                '123',
            ],
            [
                123,
                new InvalidArgumentException('Not JSON: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not JSON: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not JSON: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not JSON: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not JSON: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not JSON: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not JSON: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not JSON: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not JSON: []'),
            ],
            [
                '["a","b"]',
                '["a","b"]',
            ],
            [
                '{"a":"b"}',
                '{"a":"b"}',
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not JSON: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not JSON: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not JSON: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not JSON: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not JSON: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not JSON: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not JSON: true'),
            ],
            [
                '1',
                '1',
            ],
            [
                'off',
                new InvalidArgumentException('Not JSON: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not JSON: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not JSON: "test@example.com"'),
            ],
            [
                '123.456',
                '123.456',
            ],
            [
                123.456,
                new InvalidArgumentException('Not JSON: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not JSON: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not JSON: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not JSON: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not JSON: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not JSON: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not JSON: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not JSON: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not JSON: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not JSON: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not JSON: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not JSON: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not JSON: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
