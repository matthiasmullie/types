<?php

declare(strict_types=1);

namespace MatthiasMullie\Types;

readonly class Email extends AbstractType
{
    #[\Override]
    public function __invoke(mixed $value): string
    {
        try {
            $scalar = $this->getScalarValue($value);

            $email = filter_var($scalar, FILTER_VALIDATE_EMAIL);
            if ($email !== false) {
                return $email;
            }
        } catch (InvalidArgumentException) {
        }

        throw new InvalidArgumentException('Not an email: ' . json_encode($value));
    }
}
