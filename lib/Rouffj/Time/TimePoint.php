<?php

namespace Rouffj\Time;

use Rouffj\Time\Duration;

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

    public function equals(CalendarDate $date)
    {
        return
            $this->year === $date->getYear() &&
            $this->month === $date->getMonth() &&
            $this->day === $date->getDay()
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

    private function asPHPDateTime()
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
