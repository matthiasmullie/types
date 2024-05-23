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
        try {
            $scalar = $this->getScalarValue($value);

            if (is_string($scalar)) {
                $decoded = json_decode($scalar, true);

                if ($decoded !== null || $scalar === 'null') {
                    $result = ($this->type)($decoded);

                    return json_encode($result);
                }
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not JSON: ' . json_encode($value));
    }
}
