<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Alphanumeric extends AbstractType
{
    public function test(mixed $value): bool
    {
        return (is_string($value) || is_numeric($value)) && preg_match('/^[a-z0-9]+$/i', @(string) $value) === 1;
    }

    public function __invoke(mixed $value): string
    {
        if (!$this->test($value)) {
            throw new InvalidArgumentException('Not alphanumeric: ' . json_encode($value));
        }

        return (string) $value;
    }
}
