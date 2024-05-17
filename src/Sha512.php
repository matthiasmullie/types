<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Sha512 extends AbstractType
{
    public function test(mixed $value): bool
    {
        try {
            return preg_match('/^[a-f0-9]{128}$/i', @(string) $value) === 1;
        } catch (\Error) {
            return false;
        }
    }

    public function __invoke(mixed $value): string
    {
        if (!$this->test($value)) {
            throw new InvalidArgumentException('Not sha512: ' . json_encode($value));
        }

        return strtolower((string) $value);
    }
}
