<?php

namespace App\UseCases\MeetupEvents;

use App\Models\EventManagement\MeetupEvent;
use App\Models\EventManagement\MeetupEventPrice;
use App\Models\IdentityAndAccess\User;
use App\Shared\UseCases\EventDispatcher;
use Carbon\Carbon;

class ScheduleMeetupEvent
{

    public function __construct(private EventDispatcher $dispatcher)
    {
    }

    public function execute(ScheduleMeetupEventDTO $meetupEventDTO):int
    {
        $host = User::find($meetupEventDTO->hostId);
        if(!$host) {
            throw new \RuntimeException('Host is not valid');
        }

        $meetupEvent = MeetupEvent::schedule(
            $meetupEventDTO->title,
            $host,
            Carbon::createFromImmutable($meetupEventDTO->startsAt),
            new MeetupEventPrice($meetupEventDTO->price),
            $meetupEventDTO->description
        );
        $meetupEvent->save();

        $this->dispatcher->dispatchAll($meetupEvent->releaseEvents());

        return $meetupEvent->id;
    }
}
