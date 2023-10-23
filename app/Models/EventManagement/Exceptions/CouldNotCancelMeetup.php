<?php

namespace App\Models\EventManagement\Exceptions;

use Exception;

class CouldNotCancelMeetup extends Exception
{
    public const DATE_TO_CANCEL_IS_EXCEEDED = "The event can be canceled till one day before its scheduled date";
    public const ALREADY_CANCELED = "The event is canceled already";
    public static function causeTheDateIsExceeded():self
    {
        return new self(self::DATE_TO_CANCEL_IS_EXCEEDED);
    }

    public static function causeAlreadyCanceled():self
    {
        return new self(self::ALREADY_CANCELED);
    }
}
