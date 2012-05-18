<?php

namespace Rouffj\Time;

/**
 * CalendarDate
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class CalendarDate
{

    const SATURDAY = 6;
    const MONDAY = 1;

    public static function date($year, $month, $day)
    {
        return new self();
    }

    public static function from($year, $month, $day = null, $timezone = null)
    {
        return new self();
    }

    public function isBefore()
    {
    }

    public function isAfter()
    {
    }

    public function startAsTimePoint()
    {
    }

    public function toString($pattern)
    {
    }

    public function equals(CalendarDate $date)
    {
    }

    public function dayOfWeek()
    {
    }

    public function nextDay()
    {
        return $this;
    }
}
