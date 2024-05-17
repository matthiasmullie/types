<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class OneOf extends AbstractType
{
    /**
     * @param TypeInterface[] $types
     */
    public function __construct(private array $types, string $description = '')
    {
        parent::__construct($description);
    }

    #[\Override]
    public function test(mixed $value): bool
    {
        foreach ($this->types as $type) {
            if ($type->test($value)) {
                return true;
            }
        }

        return false;
    }

    #[\Override]
    public function __invoke(mixed $value): mixed
    {
        foreach ($this->types as $type) {
            if ($type->test($value)) {
                return ($type)($value);
            }
        }

        $allowedTypes = array_map(
            static fn(TypeInterface $type) => strtolower((new \ReflectionClass($type))->getShortName()),
            $this->types,
        );
        throw new InvalidArgumentException('Not one of type ' . implode(', ', $allowedTypes) . ': ' . json_encode($value));
    }
}
