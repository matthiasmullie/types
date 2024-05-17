<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Hexadecimal extends AbstractType
{
    public function test(mixed $value): bool
    {
        try {
            return (is_string($value) || is_numeric($value)) && preg_match('/^[a-f0-9]+$/i', @(string) $value) === 1;
        } catch (\Error) {
            return false;
        }
    }

    public function __invoke(mixed $value): string
    {
        if (!$this->test($value)) {
            throw new InvalidArgumentException('Not hexadecimal: ' . json_encode($value));
        }

        return (string) $value;
    }
}
