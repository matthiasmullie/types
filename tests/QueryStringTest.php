<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\QueryString;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class QueryStringTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new QueryString();
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                'one=',
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not query string: "two"'),
            ],
            [
                null,
                new InvalidArgumentException('Not query string: null'),
            ],
            [
                '123',
                '123=',
            ],
            [
                123,
                new InvalidArgumentException('Not query string: 123'),
            ],
            [
                'a',
                'a=',
            ],
            [
                'test',
                'test=',
            ],
            [
                'abc',
                'abc=',
            ],
            [
                'not valid',
                'not_valid=',
            ],
            [
                ['test'],
                new InvalidArgumentException('Not query string: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not query string: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not query string: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not query string: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not query string: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                '{"a":"b"}=',
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not query string: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not query string: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not query string: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not query string: {"a":"b","c":"x"}'),
            ],
            [
                1,
                new InvalidArgumentException('Not query string: 1'),
            ],
            [
                0,
                new InvalidArgumentException('Not query string: 0'),
            ],
            [
                true,
                new InvalidArgumentException('Not query string: true'),
            ],
            [
                '1',
                '1=',
            ],
            [
                'off',
                'off=',
            ],
            [
                '',
                '',
            ],
            [
                'test@example.com',
                'test@example_com=',
            ],
            [
                '123.456',
                '123_456=',
            ],
            [
                123.456,
                new InvalidArgumentException('Not query string: 123.456'),
            ],
            [
                '00ff00',
                '00ff00=',
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                '01234567890abcdef01234567890abcdef01234=',
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                '01234567890abcdef01234567890abcdef012345=',
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                '01234567890abcdef01234567890abcdef0123456=',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567=',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678=',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789=',
            ],
            [
                'www.mullie.eu',
                'www_mullie_eu=',
            ],
            [
                'http://www.mullie.eu',
                'http://www_mullie_eu=',
            ],
            [
                'http://www.mullie.eu:80',
                'http://www_mullie_eu:80=',
            ],
            [
                'http://www.mullie.eu:80?code=123',
                'http://www_mullie_eu:80?code=123',
            ],
            [
                'http://www.mullie.eu:80?code=123&redirect_uri=',
                'http://www_mullie_eu:80?code=123&redirect_uri=',
            ],
            [
                [10, 200],
                new InvalidArgumentException('Not query string: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not query string: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                'one=two&three[0]=four&three[1]=five',
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                // querystring expects a url-decoded querystring, which this is not...
                'one=two&three[0]=',
            ],
        ];
    }
}
