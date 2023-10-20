<?php

namespace App\UseCases\IdentityAndAccess;

use App\Models\IdentityAndAccess\EmailAddress;
use App\Models\IdentityAndAccess\User;
use App\Shared\UseCases\EventDispatcher;
use Illuminate\Contracts\Hashing\Hasher;

readonly class RegisterUser
{
    public function __construct(
        private Hasher          $hash,
        private EventDispatcher $dispatcher
    )
    {

    }

    public function execute(UserRegisterDTO $userRegisterDTO): void
    {
        $user = User::register(
            $userRegisterDTO->fullName,
            EmailAddress::fromString($userRegisterDTO->email),
            $this->hash->make($userRegisterDTO->password)
        );

        $user->save();
        $this->dispatcher->dispatchAll($user->releaseEvents());
    }
}
