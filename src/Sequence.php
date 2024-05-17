<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Sequence extends AbstractType
{
    public function __construct(private TypeInterface $elementsType, string $description = '')
    {
        parent::__construct($description);
    }

    #[\Override]
    public function __invoke(mixed $value): array
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException('Not a sequence: ' . json_encode($value));
        }

        foreach ($value as $i => $element) {
            if ($i !== (int) $i) {
                // double-check that this is not an associative array
                throw new InvalidArgumentException('Not a sequence: ' . json_encode($value));
            }

            $value[$i] = ($this->elementsType)($element);
        }

        return $value;
    }
}
