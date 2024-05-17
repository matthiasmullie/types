<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\Any;
use MatthiasMullie\Types\TypeInterface;

class AnyTest extends TypeTestCase
{
    public function getType(): TypeInterface
    {
        return new Any();
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
                AnEnum::Two,
            ],
            [
                null,
                null,
            ],
            [
                '123',
                '123',
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
                'abc',
            ],
            [
                'not valid',
                'not valid',
            ],
            [
                ['test'],
                ['test'],
            ],
            [
                [1, 2, 3],
                [1, 2, 3],
            ],
            [
                [['test']],
                [['test']],
            ],
            [
                [],
                [],
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
                ['a' => 'b'],
            ],
            [
                ['a' => 'b', 'c' => 'd'],
                ['a' => 'b', 'c' => 'd'],
            ],
            [
                ['a' => 'b', 'c' => null],
                ['a' => 'b', 'c' => null],
            ],
            [
                1,
                1,
            ],
            [
                0,
                0,
            ],
            [
                true,
                true,
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
                'test@example.com',
            ],
            [
                '123.456',
                '123.456',
            ],
            [
                123.456,
                123.456,
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
                [10, 200],
            ],
            [
                [10, 20],
                [10, 20],
            ],
            [
                'one=two&three[]=four&three[]=five',
                'one=two&three[]=four&three[]=five',
            ],
            [
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
                'one%3Dtwo%26three%5B0%5D%3Dfour%26three%5B1%5D%3Dfive',
            ],
        ];
    }
}
