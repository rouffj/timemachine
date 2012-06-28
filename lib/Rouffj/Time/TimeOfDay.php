<?php

namespace Rouffj\Time;

class TimeOfDay
{
    private $hour;
    private $minutes;

    public function __construct($hour, $minutes)
    {
        $this->hour = $hour;
        $this->minutes = $minutes;
    }
}

