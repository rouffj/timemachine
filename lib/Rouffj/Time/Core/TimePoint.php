<?php

namespace Rouffj\Time\Core;

class TimePoint
{
    private $year;
    private $month;
    private $day;
    private $hour;
    private $minute;
    private $second;

    public function __construct($year, $month, $day, $hour, $minute, $second = 0)
    {
        $this->year = (int)$year;
        $this->month = (int)$month;
        $this->day = (int)$day;
        $this->hour = (int)$hour;
        $this->minute = (int)$minute;
        $this->second = (int)$second;
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
            $this->year === $point->getYear() &&
            $this->month === $point->getMonth() &&
            $this->day === $point->getDay() &&
            $this->hour === $point->getHour() &&
            $this->minute === $point->getMinute() &&
            $this->second === $point->getSecond()
        ;
    }

    /**
     * Gets the value of year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Gets the value of month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Gets the value of day
     *
     * @return int
     */
    public function getDay()
    {
        return $this->day;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function getMinute()
    {
        return $this->minute;
    }

    public function getSecond()
    {
        return $this->second;
    }

    public function asPHPDateTime()
    {
        $date = new \Datetime();
        $date->setDate($this->year, $this->month, $this->day);
        $date->setTime($this->hour, $this->minute, $this->second);

        return $date;
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
