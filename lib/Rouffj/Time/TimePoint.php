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

    public function toString($pattern = null, \DateTimeZone $zone = null)
    {
        return '';
    }

    public function asJavaUtilDate()
    {
        return new \DateTime();
    }

    public function backToMidnight(\DateTimeZone $zone)
    {
        return new self();
    }

    public static function fromDate(\DateTime $datetime)
    {
        return $this->from($datetime->getTimestamp());
    }

    public static function from($millisecond)
    {
        return new self();
    }

    public function isSameDayAs(TimePoint $other, \DateTimeZone $zone)
    {
        return false;
    }

    public function isBeforeInterval(TimeInterval $interval)
    {
        return false;
    }

    public function isBefore(TimePoint $other)
    {
        return false;
    }

    public function isAfterInterval(TimeInterval $interval)
    {
        return false;
    }

    public function isAfter(TimePoint $other)
    {
        return false;
    }



    public function equals(TimePoint $datetime)
    {
        return false;
    }

    public function plus(Duration $duration)
    {
        return new self();
    }

    public function minus(Duration $duration)
    {
        return new self();
    }

    public function nextDay()
    {
        return new self();
    }

    public function compareTo(TimePoint $other)
    {
        return 0;
    }

    public function asJavaCalendar()
    {
        return new \DateTime();
    }
}
