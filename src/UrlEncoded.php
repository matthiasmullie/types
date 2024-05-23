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

            if (is_string($scalar)) {
                $decoded = urldecode($scalar);
                $reencoded = urlencode($decoded);

                if ($reencoded === $scalar) {
                    $result = ($this->type)($decoded);

                    return urlencode($result);
                }
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not url encoded: ' . json_encode($value));
    }
}
