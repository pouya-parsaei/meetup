<?php

namespace App\Models\IdentityAndAccess;


class EmailAddress
{
    public function __construct(private string $emailAddress)
    {
        $this->validate($this->emailAddress);
    }

    private function validate(string $emailAddress): void
    {
        // Do not use filter_var method in real projects, as it seems there are some security issues with that
        if (false === filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('The email address is invalid');
        }
    }

    public static function fromString(string $emailAddress):EmailAddress
    {
        return new self($emailAddress);
    }
    public function value(): string
    {
        return $this->emailAddress;
    }

    public function __toString():string
    {
        return $this->emailAddress;
    }
}
