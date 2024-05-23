<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Hexadecimal extends AbstractType
{
    public function __invoke(mixed $value): string
    {
        try {
            $scalar = $this->getScalarValue($value);
            if (
                !is_bool($scalar) &&
                preg_match('/^[a-f0-9]+$/i', (string) $scalar) === 1
            ) {
                return (string) $scalar;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not hexadecimal: ' . json_encode($value));
    }
}
