<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Enum extends AbstractType
{
    /**
     * @param mixed[] $cases
     */
    public function __construct(private array $cases, private TypeInterface $type = new Any(), string $description = '')
    {
        parent::__construct($description);
    }

    #[\Override]
    public function __invoke(mixed $value): mixed
    {
        $enum = ($this->type)($value);

        foreach ($this->cases as $case) {
            if ($enum === $case) {
                return $case;
            }

            if ($case instanceof \BackedEnum && (is_string($enum) || is_int($enum))) {
                try {
                    return $case::from($enum);
                } catch (\Error) {
                    // no match; continue...
                }
            }
        }

        throw new InvalidArgumentException('Not a valid enum value: ' . json_encode($value));
    }
}
