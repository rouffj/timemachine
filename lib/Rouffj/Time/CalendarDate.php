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

    private $year;
    private $month;
    private $day;


    public function __construct($year, $month, $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    public static function date($year, $month, $day)
    {
        return self::from($year, $month, $day);
    }

    public static function from($year, $month, $day = null, $timezone = null)
    {
        return new self($year, $month, $day);
    }

    // helper
    public static function fromTimePoint(TimePoint $timePoint, \DateTimeZone $timezone)
    {
        return new self($year, $month, $day);
    }

    public function isBefore(CalendarDate $other)
    {
        if ($this->year < $other->getYear()) {
            return true;
        }

        if ($this->year > $other->getYear()) {
            return false;
        }

        if ($this->month < $other->getMonth()) {
            return true;
        }

        if ($this->month > $other->getMonth()) {
            return false;
        }

        return $this->day < $other->getDay();
    }

    public function isAfter(CalendarDate $other)
    {
        return !$this->isBefore($other) && !$this->equals($other);
    }

    public function startAsTimePoint(\DateTimeZone $timezone)
    {
       return TimePoint::atMidnight($this->year, $this->month, $this->day, $timezone);
    }

    public function toString($pattern = 'yyyy-M-d')
    {
        $tz = new \DateTimeZone('UTC');
        $point = $this->startAsTimePoint($tz);

        return $point->toString($pattern, $tz);
    }

    public function equals(CalendarDate $other)
    {
        return 
            $this->year === $other->getYear() &&
            $this->month === $other->getMonth() &&
            $this->day === $other->getDay();
    }

    public function dayOfWeek()
    {
        $date = $this->asDateTimeUTCMidnight();

        return $date->format('N');
    }

    public function nextDay()
    {
        return $this->plusDays(1);
    }

    public function previousDay()
    {
        return $this->plusDays(-1);
    }

    public function month()
    {
        return CalendarInterval::month($this->year, $this->month);
    }

    public function year()
    {
        return CalendarInterval::year($this->year);
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getDay()
    {
        return $this->day;
    }

    private function plusDays($increment)
    {
        $date = $this->asDateTimeUTCMidnight();
        $interval = new \DateInterval(sprintf('P%sD', abs($increment)));
        if ($increment >= 0) {
            $date->add($interval);
        } else {
            $date->sub($interval);
        }
        $year = $date->format('Y');
        $month = $date->format('n');
        $day = $date->format('j');

        return CalendarDate::date($year, $month, $day);
    }

    private function asDateTimeUTCMidnight()
    {
        $zone = new \DateTimeZone('UTC');
        $date = new \DateTime();
        $date->setTimezone($zone);
        $date->setDate($this->year, $this->month, $this->day);
        $date->setTime(0, 0, 0);

        return $date;
    }

    public function asTimeInterval(\DateTimeZone $zone) {
        return new TimeInterval();
    }
}
