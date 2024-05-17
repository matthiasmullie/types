<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Coordinate;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class CoordinateTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Coordinate();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not a coordinate: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not a coordinate: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not a coordinate: null'),
            ],
            [
                '123',
                new InvalidArgumentException('Not a coordinate: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not a coordinate: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not a coordinate: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not a coordinate: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not a coordinate: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not a coordinate: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not a coordinate: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not a coordinate: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not a coordinate: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not a coordinate: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not a coordinate: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not a coordinate: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not a coordinate: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not a coordinate: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not a coordinate: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not a coordinate: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not a coordinate: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not a coordinate: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not a coordinate: true'),
            ],
            [
                '1',
                new InvalidArgumentException('Not a coordinate: "1"'),
            ],
            [
                'off',
                new InvalidArgumentException('Not a coordinate: "off"'),
            ],
            [
                '',
                new InvalidArgumentException('Not a coordinate: ""'),
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not a coordinate: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not a coordinate: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not a coordinate: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not a coordinate: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not a coordinate: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                new InvalidArgumentException('Not a coordinate: "01234567890abcdef01234567890abcdef012345"'),
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not a coordinate: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not a coordinate: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                new InvalidArgumentException('Not a coordinate: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not a coordinate: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not a coordinate: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not a coordinate: [10,200]'),
            ],
            [
                [10, 20],
                [10.0, 20.0],
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not a coordinate: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not a coordinate: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
