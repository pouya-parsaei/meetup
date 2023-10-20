<?php

namespace App\UseCases\IdentityAndAccess;

readonly class UserRegisterDTO
{
    public function __construct(
        public string $fullName,
        public string $email,
        public string $password
    )
    {

    }
}
