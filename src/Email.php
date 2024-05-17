<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Email extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): string
    {
        $email = filter_var($value, FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            throw new InvalidArgumentException('Not an email: ' . json_encode($value));
        }

        return $email;
    }
}
