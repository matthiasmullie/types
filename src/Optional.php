<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Optional extends AbstractType
{
    public function __construct(private TypeInterface $type, private mixed $fallback = null, string $description = '')
    {
        parent::__construct($description);
    }

    #[\Override]
    public function __invoke(mixed $value): mixed
    {
        if ($value !== null) {
            return ($this->type)($value);
        }

        if ($this->fallback !== null) {
            return ($this->type)($this->fallback);
        }

        return null;
    }
}
