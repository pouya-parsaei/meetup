<?php

namespace App\Listeners;

use App\Models\IdentityAndAccess\Events\UserRegistered;

class SendWelcomeEmail
{
    public function handle(UserRegistered $event): void
    {
        //
    }
}
