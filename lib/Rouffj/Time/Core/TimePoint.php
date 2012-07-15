<?php

namespace Rouffj\Time\Core;

class TimePoint
{
    private $date;
    private $time;

    public function __construct($year, $month, $day, $hour, $minute, $second = 0)
    {
        $this->date = new CalendarDate($year, $month, $day);
        $this->time = new TimeOfDay($hour, $minute, $second);
    }

    public function during(Duration $duration)
    {
        $interval = $this->plus($duration);

        return new TimeInterval($this, $interval);
    }

    public function until(TimePoint $point)
    {
        return new TimeInterval($this, $point);
    }

    public function plus(Duration $duration)
    {
        $date = $this->asPHPDateTime();
        $date->add($duration->asPHPDateInterval());

        return $this->buildFromPHPDateTime($date);
    }

    public function minus(Duration $duration)
    {
        $date = $this->asPHPDateTime();
        $date->sub($duration->asPHPDateInterval());

        return $this->buildFromPHPDateTime($date);
    }

    public function equals(TimePoint $point)
    {
        return
            $this->date->getYear() === $point->getYear() &&
            $this->date->getMonth() === $point->getMonth() &&
            $this->date->getDay() === $point->getDay() &&
            $this->time->getHour() === $point->getHour() &&
            $this->time->getMinutes() === $point->getMinutes() &&
            $this->time->getSeconds() === $point->getSeconds()
        ;
    }

    /**
     * Gets the value of year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->date->getYear();
    }

    /**
     * Gets the value of month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->date->getMonth();
    }

    /**
     * Gets the value of day
     *
     * @return int
     */
    public function getDay()
    {
        return $this->date->getDay();;
    }

    public function getHour()
    {
        return $this->time->getHour();
    }

    public function getMinutes()
    {
        return $this->time->getMinutes();
    }

    public function getSeconds()
    {
        return $this->time->getSeconds();
    }

    public function asPHPDateTime()
    {
        $dtime = $this->date->toDateTime();
        $dtime->setTime($this->time->getHour(), $this->time->getMinutes(), $this->time->getSeconds());

        return $dtime;
    }

    public function toCalendarDate()
    {
        return $this->date;
    }

    private function buildFromPHPDateTime(\DateTime $date)
    {
        return new self(
            $date->format('Y'),
            $date->format('m'),
            $date->format('d'),
            $date->format('H'),
            $date->format('i'),
            $date->format('s')
        );
    }
}
