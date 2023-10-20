<?php

namespace App\UseCases\IdentityAndAccess;

use App\Models\IdentityAndAccess\User;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Hashing\Hasher;

class LoginUser
{
    public function __construct(
        private Hasher  $hash,
        private Factory $guardFactory
    )
    {

    }

    public function execute(LoginUserDTO $loginUserDTO): void
    {
        $user = User::whereEmail($loginUserDTO->emailAddress)->first();

        if (is_null($user)) {
            throw new \RuntimeException('User not found');
        }

        $isPasswordMatched = $this->hash->check($loginUserDTO->password, $user->password);

        if (!$isPasswordMatched) {
            throw new \RuntimeException('User not found');
        }

        $foundUser = $this->guardFactory->guard('api')->attempt([
            'email' => $loginUserDTO->emailAddress,
            'password' => $loginUserDTO->password
        ]);

        if(!$foundUser) {
            throw new \RuntimeException('User not found');
        }
    }
}
