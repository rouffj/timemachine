<?php

namespace Rouffj\Time;

/**
 * CalendarDate
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class CalendarInterval
{
    public static function inclusive()
    {
        return new self();
    }

    public static function month($year, $month)
    {
        return new self();
    }

    public static function year($year)
    {
        return new self();
    }
}
