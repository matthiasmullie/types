<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Any extends AbstractType
{
    public function __invoke(mixed $value): mixed
    {
        return $value;
    }
}
