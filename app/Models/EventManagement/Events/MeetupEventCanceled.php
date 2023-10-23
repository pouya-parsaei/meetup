<?php

namespace App\Models\EventManagement\Events;

use App\Models\EventManagement\MeetupEvent;
use App\Shared\Models\Events\Event;

readonly class MeetupEventCanceled implements Event
{
    public function __construct(public MeetupEvent $meetupEvent)
    {
    }
}
