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

    public function getScalarValue(mixed $value): int|float|string|bool
    {
        if (is_scalar($value)) {
            return $value;
        }

        if ($value instanceof \BackedEnum) {
            return $value->value;
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return (string) $value;
        }

        throw new InvalidArgumentException('Not scalar: ' . json_encode($value));
    }
}
