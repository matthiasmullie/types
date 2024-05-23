<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Text extends AbstractType
{
    public function __invoke(mixed $value): string
    {
        try {
            return (string) $this->getScalarValue($value);
        } catch (InvalidArgumentException) {
            throw new InvalidArgumentException('Not text: ' . json_encode($value));
        }
    }
}
