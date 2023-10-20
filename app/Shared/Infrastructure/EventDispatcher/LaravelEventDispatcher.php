<?php

namespace App\Shared\Infrastructure\EventDispatcher;

use App\Shared\Models\Events\Event;
use App\Shared\UseCases\EventDispatcher;
use Illuminate\Contracts\Events\Dispatcher;

class LaravelEventDispatcher implements EventDispatcher
{
    public function __construct(private Dispatcher $dispatcher)
    {

    }

    public function dispatch(Event $event): void
    {
        $this->dispatcher->dispatch($event);
    }

    public function dispatchAll(array $events): void
    {
        collect($events)->tap(fn(Event $event) => $this->dispatch($event));
    }
}
