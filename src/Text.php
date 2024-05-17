<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Text extends AbstractType
{
    public function test(mixed $value): bool
    {
        return (is_object($value) && method_exists($value, '__toString')) || is_scalar($value);
    }

    public function __invoke(mixed $value): string
    {
        if (!$this->test($value)) {
            throw new InvalidArgumentException('Not text: ' . json_encode($value));
        }

        return (string) $value;
    }
}
