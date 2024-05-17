<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

abstract readonly class AbstractType implements TypeInterface
{
    public function __construct(public string $description = '') {}

    public function test(mixed $value): bool
    {
        try {
            ($this)($value);

            return true;
        } catch (InvalidArgumentException) {
            return false;
        }
    }
}
