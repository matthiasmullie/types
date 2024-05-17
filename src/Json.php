<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Json extends AbstractType
{
    public function __construct(private TypeInterface $type = new Any(), string $description = '')
    {
        parent::__construct($description);
    }

    #[\Override]
    public function __invoke(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Not JSON: ' . json_encode($value));
        }

        $decoded = json_decode($value, true);
        if ($decoded === null && $value !== 'null') {
            throw new InvalidArgumentException('Not JSON: ' . json_encode($value));
        }

        $result = ($this->type)($decoded);

        return json_encode($result);
    }
}
