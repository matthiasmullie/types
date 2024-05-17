<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Double extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): float
    {
        if (is_float($value)) {
            return $value;
        }

        $double = filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($double === false) {
            throw new InvalidArgumentException('Not a double: ' . json_encode($value));
        }

        return $double;
    }
}
