<?php

namespace App\Providers;

use App\Listeners\SendWelcomeEmail;
use App\Models\EventManagement\Events\MeetupEventCanceled;
use App\Models\IdentityAndAccess\Events\UserRegistered;
use App\UseCases\MeetupEvents\EventHandlers\SendCancelNotification;
use App\UseCases\Payment\EventHandlers\RefundMeetupEventFee;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        UserRegistered::class => [
            SendWelcomeEmail::class
        ],

        MeetupEventCanceled::class => [
            RefundMeetupEventFee::class,
            SendCancelNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
