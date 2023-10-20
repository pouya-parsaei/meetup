<?php

namespace App\Models\IdentityAndAccess;

enum UserStatus:int
{
    case Active = 1;
    case Banned = 2;
}
