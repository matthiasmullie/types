<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Coordinate extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): array
    {
        if (
            !is_array($value)
            || !isset($value[0], $value[1])
            || count($value) > 2
            || $value[0] < -90 || $value[0] > 90 // latitude
            || $value[1] < -180 || $value[1] > 180 // longitude
        ) {
            throw new InvalidArgumentException('Not a coordinate: ' . json_encode($value));
        }

        return [
            (float) $value[0],
            (float) $value[1],
        ];
    }
}
