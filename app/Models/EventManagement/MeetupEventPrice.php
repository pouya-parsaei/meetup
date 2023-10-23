<?php

namespace App\Models\EventManagement;


use InvalidArgumentException;

readonly class MeetupEventPrice
{

    public function __construct(private int $amount)
    {
        $this->validate();
    }

    private function validate(int $amount):void
    {
        if($amount < 0){
            throw new InvalidArgumentException('Amount must be a positive number');
        }
    }

    public function value():int
    {
        return $this->amount;
    }

    public static function fromString(string $amount):MeetupEventPrice
    {
        return new self((int)$amount);
    }

    public static function free():MeetupEventPrice
    {
        return new self(0);
    }
}
