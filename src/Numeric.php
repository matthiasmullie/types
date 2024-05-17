<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Numeric extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): int|float
    {
        if (is_int($value) || is_float($value)) {
            return $value;
        }

        $number = filter_var($value, FILTER_VALIDATE_INT) ?: filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($number === false) {
            throw new InvalidArgumentException('Not numeric: ' . json_encode($value));
        }

        return $number;
    }
}
