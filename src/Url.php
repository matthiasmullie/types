<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Url extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): string
    {
        try {
            $scalar = $this->getScalarValue($value);

            $url = filter_var($scalar, FILTER_VALIDATE_URL);
            if ($url !== false) {
                return $url;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not a url: ' . json_encode($value));
    }
}
