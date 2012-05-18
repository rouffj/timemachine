<?php

namespace Rouffj\Time;

/**
* 
* @author Julien Galenski <julien.galenski@gmail.com>
*/
class Duration 
{
    public static function days($howMany)
    {
        return new self();
    }

    public function addedTo(TimePoint $point)
    {
        return new TimePoint();
    }

    public function subtractedFrom(TimePoint $point) {
        return new TimePoint();
    }
}