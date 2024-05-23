<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Sha512 extends AbstractType
{
    public function __invoke(mixed $value): string
    {
        try {
            $scalar = $this->getScalarValue($value);
            if (preg_match('/^[a-f0-9]{128}$/i', (string) $scalar) === 1) {
                return strtolower((string) $scalar);
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not sha512: ' . json_encode($value));
    }
}
