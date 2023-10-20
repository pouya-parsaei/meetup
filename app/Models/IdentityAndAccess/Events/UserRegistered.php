<?php

namespace App\Models\IdentityAndAccess\Events;

use App\Models\IdentityAndAccess\User;
use App\Shared\Models\Events\Event;

readonly class UserRegistered implements Event
{
    public function __construct(public User $user)
    {

    }
}
