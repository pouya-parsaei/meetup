<?php

namespace App\Shared\Models\Events;

trait EventRecording
{
    private array $events = [];

    public function recordEvent(Event $event): void
    {

    }

    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}
