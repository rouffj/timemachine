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

    public static function atGMT($year, $month, $date, $hour, $minute, $second = 0, $millisecond = 0)
    {
        return new self();
    }

    public static function at($year, $month, $date, $hour, $minute, $second, $millisecond, \DateTimeZone $zone)
    {
        return new self();
    }

    public function at12hr($year, $month, $date, $hour, $am_pm, $minute, $second, $millisecond, \DateTimeZone $zone)
    {
        return new self();
    }

    public function parseGMTFrom($dateString, $pattern)
    {
        return new self();
    }
}
