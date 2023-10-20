<?php

namespace App\Shared\UseCases;

use App\Shared\Models\Events\Event;

interface EventDispatcher
{
    public function dispatch(Event $event): void;

    /** @param array<Event> $events */
    public function dispatchAll(array $events): void;
}
