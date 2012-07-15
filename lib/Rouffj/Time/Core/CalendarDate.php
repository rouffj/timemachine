<?php

namespace Rouffj\Time\Core;

class CalendarDate
{
    private $year;
    private $month;
    private $day;

    public function __construct($year, $month, $day)
    {
        $this->year = (int)$year;
        $this->month = (int)$month;
        $this->day = (int)$day;
    }

    public function greater(CalendarDate $date)
    {
        return
            $this->year > $date->getYear() ||
            ($this->year >= $date->getYear() && $this->month > $date->getMonth()) ||
            ($this->year >= $date->getYear() && $this->month >= $date->getMonth() && $this->day > $date->getDay())
        ;
    }

    public function equals(CalendarDate $date)
    {
        return
            $this->year === $date->getYear() &&
            $this->month === $date->getMonth() &&
            $this->day === $date->getDay()
        ;
    }

    public function next()
    {
        $date = $this->toDateTime();
        $date->add(new \DateInterval('P1D'));

        return new self($date->format('Y'), $date->format('m'), $date->format('d'));
    }

    public function toDateTime()
    {
        $date = new \Datetime();
        $date->setDate($this->year, $this->month, $this->day);

        return $date;
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
}
