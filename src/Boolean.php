<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Boolean extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): bool
    {
        if (is_null($value)) {
            return false;
        }

        try {
            $scalar = $this->getScalarValue($value);

            if (is_bool($scalar)) {
                return $scalar;
            }

            $bool = filter_var($scalar, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($bool !== null) {
                return $bool;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not a boolean: ' . json_encode($value));
    }
}
