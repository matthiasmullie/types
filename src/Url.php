<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Url extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): string
    {
        $url = filter_var($value, FILTER_VALIDATE_URL);
        if ($url === false) {
            throw new InvalidArgumentException('Not a url: ' . json_encode($value));
        }

        return $url;
    }
}
