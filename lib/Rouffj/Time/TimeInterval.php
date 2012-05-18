<?php

namespace Rouffj\Time;

/**
* 
* @author Julien Galenski <julien.galenski@gmail.com>
*/
class TimeInterval 
{
    public static function closed(TimePoint $start, TimePoint $end)
    {
        return new self();
    }

    public function isAfter(TimePoint $point) {
        return false;
    }

    public function start()
    {
        return new TimePoint();
    }
}