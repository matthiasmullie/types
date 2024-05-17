<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class UrlEncoded extends AbstractType
{
    public function __construct(private TypeInterface $type = new Any(), string $description = '')
    {
        parent::__construct($description);
    }

    #[\Override]
    public function __invoke(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Not url encoded: ' . json_encode($value));
        }

        $decoded = urldecode($value);
        $reencoded = urlencode($decoded);
        if ($reencoded !== $value) {
            throw new InvalidArgumentException('Not url encoded: ' . json_encode($value));
        }

        $result = ($this->type)($decoded);

        return urlencode($result);
    }
}
