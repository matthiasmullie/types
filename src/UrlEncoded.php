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
        try {
            $scalar = $this->getScalarValue($value);
        } catch (InvalidArgumentException) {
            throw new InvalidArgumentException('Not url encoded: ' . json_encode($value));
        }

        if (!is_string($scalar)) {
            throw new InvalidArgumentException('Not url encoded: ' . json_encode($value));
        }

        $decoded = urldecode($scalar);
        $reencoded = urlencode($decoded);
        if ($reencoded !== $scalar) {
            throw new InvalidArgumentException('Not url encoded: ' . json_encode($value));
        }

        $result = ($this->type)($decoded);

        return urlencode($result);
    }
}
