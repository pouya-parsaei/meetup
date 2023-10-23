<?php

namespace App\UseCases\MeetupEvents\EventHandlers;

use App\Models\EventManagement\Events\MeetupEventCanceled;

class SendCancelNotification
{
    public function handle(MeetupEventCanceled $meetupEventCanceled):void
    {

    }
}
