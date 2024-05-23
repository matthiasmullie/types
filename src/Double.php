<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Double extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): float
    {
        try {
            $scalar = $this->getScalarValue($value);

            if (is_float($scalar)) {
                return $scalar;
            }

            $double = filter_var($scalar, FILTER_VALIDATE_FLOAT);
            if ($double !== false) {
                return $double;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not a double: ' . json_encode($value));
    }
}
