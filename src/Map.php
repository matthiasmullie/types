<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Map extends AbstractType
{
    /**
     * @param TypeInterface[] $elements
     */
    public function __construct(private array $elements, string $description = '')
    {
        parent::__construct($description);
    }

    #[\Override]
    public function __invoke(mixed $value): array
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException('Not a map: ' . json_encode($value));
        }

        // note: data not matching an element will be discarded silently
        $results = [];
        foreach ($this->elements as $name => $element) {
            try {
                $result = ($element)($value[$name] ?? null);
            } catch (InvalidArgumentException $e) {
                throw new InvalidArgumentException("Invalid {$name}. {$e->getMessage()}");
            }

            // only add to results array if we end up with a value, or null was explicitly set;
            // otherwise, don't add nulls to map
            if (array_key_exists($name, $value) || $result !== null) {
                $results[$name] = $result;
            }
        }

        return $results;
    }
}
