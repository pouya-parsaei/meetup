<?php

namespace App\UseCases\MeetupEvents;

use App\Models\EventManagement\MeetupEvent;
use App\Shared\UseCases\EventDispatcher;

class CancelMeetupEvent
{

    public function __construct(private EventDispatcher $dispatcher)
    {
    }

    public function execute(int $meetUpId):void
    {
        /** @var ?MeetupEvent $meetUp */
        $meetUp = MeetupEvent::find($meetUpId);

        if(!$meetUp){
            throw new \RuntimeException('Invalid meet up');
        }

        $meetUp->cancel();

        $meetUp->save();

        $this->dispatcher->dispatchAll($meetUp->releaseEvents());
    }
}
