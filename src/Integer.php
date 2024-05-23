<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Integer extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): int
    {
        try {
            $scalar = $this->getScalarValue($value);

            if (is_int($scalar)) {
                return $scalar;
            }

            $int = filter_var($scalar, FILTER_VALIDATE_INT);
            if ($int !== false) {
                return $int;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not an integer: ' . json_encode($value));
    }
}
