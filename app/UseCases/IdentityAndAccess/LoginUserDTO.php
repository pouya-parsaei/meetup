<?php

namespace App\UseCases\IdentityAndAccess;

readonly class LoginUserDTO
{
    public function __construct(
        public string $emailAddress,
        public string $password
    )
    {

    }
}
