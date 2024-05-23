<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Numeric extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): int|float
    {
        try {
            $scalar = $this->getScalarValue($value);

            if (is_int($scalar) || is_float($scalar)) {
                return $scalar;
            }

            $number = filter_var($scalar, FILTER_VALIDATE_INT) ?: filter_var($scalar, FILTER_VALIDATE_FLOAT);
            if ($number !== false) {
                return $number;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not numeric: ' . json_encode($value));
    }
}
