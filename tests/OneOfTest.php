<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Boolean;
use MatthiasMullie\Types\OneOf;
use MatthiasMullie\Types\Sha1;
use MatthiasMullie\Types\Sha512;
use MatthiasMullie\Types\TypeInterface;
use MatthiasMullie\Types\InvalidArgumentException;

class OneOfTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new OneOf([new Sha1(), new Sha512(), new Boolean()]);
    }

    public static function provider(): array
    {
        return [
            [
                'one',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "one"'),
            ],
            [
                AnEnum::Two,
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "two"'),
            ],
            [
                null,
                false,
            ],
            [
                '123',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "123"'),
            ],
            [
                123,
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: 123'),
            ],
            [
                'a',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "a"'),
            ],
            [
                'test',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "test"'),
            ],
            [
                'abc',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "abc"'),
            ],
            [
                'not valid',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "not valid"'),
            ],
            [
                ['test'],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: ["test"]'),
            ],
            [
                [1, 2, 3],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: [1,2,3]'),
            ],
            [
                [['test']],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: [["test"]]'),
            ],
            [
                [],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: []'),
            ],
            [
                '["a","b"]',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "[\"a\",\"b\"]"'),
            ],
            [
                '{"a":"b"}',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "{\"a\":\"b\"}"'),
            ],
            [
                ['a' => 'b'],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: {"a":"b"}'),
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: {"a":"b","c":"d"}'),
            ],
            [
                ['a' => 'b', 'c' => null],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: {"a":"b","c":null}'),
            ],
            [
                ['a' => 'b', 'c' => 'x'],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: {"a":"b","c":"x"}'),
            ],
            [
                1,
                true,
            ],
            [
                0,
                false,
            ],
            [
                true,
                true,
            ],
            [
                '1',
                true,
            ],
            [
                'off',
                false,
            ],
            [
                '',
                false,
            ],
            [
                'test@example.com',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "test@example.com"'),
            ],
            [
                '123.456',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "123.456"'),
            ],
            [
                123.456,
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: 123.456'),
            ],
            [
                '00ff00',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "00ff00"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "01234567890abcdef01234567890abcdef01234"'),
            ],
            [
                '01234567890abcdef01234567890abcdef012345',
                '01234567890abcdef01234567890abcdef012345',
            ],
            [
                '01234567890abcdef01234567890abcdef0123456',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "01234567890abcdef01234567890abcdef0123456"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567"'),
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef012345678',
            ],
            [
                '01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef01234567890abcdef0123456789"'),
            ],
            [
                'www.mullie.eu',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "www.mullie.eu"'),
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
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: [10,200]'),
            ],
            [
                [10, 20],
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: [10,20]'),
            ],
            [
                'one=two&three[]=four&three[]=five',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "one=two&three[]=four&three[]=five"'),
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                new InvalidArgumentException('Not one of type sha1, sha512, boolean: "one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive"'),
            ],
        ];
    }
}
