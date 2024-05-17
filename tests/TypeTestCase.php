<?php

declare(strict_types=1);

namespace MatthiasMullie\Types\Tests;

use MatthiasMullie\Types\TypeInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

abstract class TypeTestCase extends TestCase
{
    abstract public function getType(): TypeInterface;

    abstract public static function provider(): array;

    #[DataProvider('provider')]
    public function testTest(mixed $value, mixed $result): void
    {
        $expect = !$result instanceof \InvalidArgumentException;
        static::assertEquals($expect, $this->getType()->test($value));
    }

    #[DataProvider('provider')]
    public function testInvoke(mixed $value, mixed $expect): void
    {
        if ($expect instanceof \InvalidArgumentException) {
            $this->expectException($expect::class);
            $this->expectExceptionMessage($expect->getMessage());
        }

        $cast = $this->getType()($value);
        static::assertSame($expect, $cast);
    }
}
