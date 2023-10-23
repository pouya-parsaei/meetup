<?php

namespace App\Models\EventManagement;

enum MeetupEventStatus:int
{
    case Pending = 1;
    case Canceled = 2;
}
