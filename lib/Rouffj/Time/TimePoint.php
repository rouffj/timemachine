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

    public static function atMidnightGMT($year, $month, $day)
    {
        return new self();
    }

    public static function atGMT($year, $month, $date, $hour, $minute, $second, $millisecond)
    {
        return new self();
    }

    public static function at($year, $month, $date, $hour, $minute, $second, TimeZone $zone)
    {
        return new self();
    }
}
