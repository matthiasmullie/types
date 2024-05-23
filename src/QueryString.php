<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class QueryString extends AbstractType
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
                parse_str($scalar, $parsed);

                if (!empty($parsed) || trim($scalar) === '') {
                    $result = ($this->type)($parsed);

                    return urldecode(http_build_query($result));
                }
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not query string: ' . json_encode($value));
    }
}
