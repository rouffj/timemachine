<?php

namespace Rouffj\Time\Core;

class TimeOfDay
{
    private $hour;
    private $minutes;

    public function __construct($hour, $minutes)
    {
        $this->hour = $hour;
        $this->minutes = $minutes;
    }

    public function __toString()
    {
        return $this->hour.':'.$this->minutes;
    }
}

