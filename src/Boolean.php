<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Boolean extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        $bool = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($bool === null) {
            throw new InvalidArgumentException('Not a boolean: ' . json_encode($value));
        }

        return $bool;
    }
}
