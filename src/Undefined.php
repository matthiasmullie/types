<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Undefined extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): null
    {
        if (!$value) {
            return null;
        }

        try {
            $scalar = $this->getScalarValue($value);

            if (!$scalar) {
                return null;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not undefined: ' . json_encode($value));
    }
}
