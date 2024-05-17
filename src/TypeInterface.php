<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

/**
 * @property string $description
 */
interface TypeInterface
{
    /**
     * Invoke the type on given input; converting/casting it as possible,
     * or throwing an exception upon failure.
     *
     * @throws InvalidArgumentException
     */
    public function __invoke(mixed $value): mixed;

    /**
     * Simply checks whether the value matches the type, without actually
     * converting/casting it.
     */
    public function test(mixed $value): bool;
}
