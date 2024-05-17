<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Integer extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): int
    {
        if (is_int($value)) {
            return $value;
        }

        $int = filter_var($value, FILTER_VALIDATE_INT);
        if ($int === false) {
            throw new InvalidArgumentException('Not an integer: ' . json_encode($value));
        }

        return $int;
    }
}
