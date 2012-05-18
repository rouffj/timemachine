<?php

namespace Rouffj\Time;

/**
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class TimePoint
{
    public static function atMidnight($year, $month, $day, \DateTimeZone $timezone)
    {
        return new self();
    }
}
