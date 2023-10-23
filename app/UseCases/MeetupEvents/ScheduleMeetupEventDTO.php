<?php

namespace App\UseCases\MeetupEvents;

readonly class ScheduleMeetupEventDTO
{

    public function __construct(
        public string $title,
        public int $hostId,
        public int $price,
        public \DateTimeImmutable $startsAt,
        public string $description
    )
    {
    }
}
