<?php

namespace App\Models\EventManagement;

use App\Models\EventManagement\Events\MeetupEventCanceled;
use App\Models\EventManagement\Events\MeetupEventScheduled;
use App\Models\EventManagement\Exceptions\CouldNotCancelMeetup;
use App\Models\IdentityAndAccess\User;
use App\Shared\Models\Events\EventRecording;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** @property string $title */
/** @property User $host */
/** @property int $price */
/** @property string $description */
/** @property Carbon $startsAt */
/** @property MeetupEventStatus $status */
/** @property Carbon $createdAt */

/** @property Carbon $updatedAt */
class MeetupEvent extends Model
{
    use EventRecording;

    public const CREATED_AT = 'createdAt';
    public const UPDATED_AT = 'updatedAt';
    protected $casts = [
        'startsAt' => 'datetime',
        'status' => MeetupEventStatus::class
    ];

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public static function schedule(
        string           $title,
        User             $host,
        Carbon           $startsAt,
        MeetupEventPrice $price,
        string           $description
    ): MeetupEvent
    {
        $event = new MeetupEvent;
        $event->title = $title;
        $event->host = $host;
        $event->description = $description;
        $event->price = $price->value();

        if ($startsAt->isPast()) {
            throw new \InvalidArgumentException('Meet starts at could not be in the past');
        }

        $event->startsAt = $startsAt;

        $event->recordEvent(new MeetupEventScheduled($event));

        return $event;
    }

    public function cancel(): void
    {
        $allowedDateToCancel = Carbon::today()->subDay();
        if ($this->startsAt->gte($allowedDateToCancel)) {
            throw CouldNotCancelMeetup::causeTheDateIsExceeded();
        }

        if ($this->isCanceled()) {
            throw CouldNotCancelMeetup::causeAlreadyCanceled();
        }

        $this->status = MeetupEventStatus::Canceled;

        $this->recordEvent(new MeetupEventCanceled($this));
    }

    public function isCanceled(): bool
    {
        return $this->status === MeetupEventStatus::Canceled;
    }

    public function reschedule():void
    {

    }
}
