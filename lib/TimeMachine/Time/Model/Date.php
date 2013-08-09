<?php

namespace TimeMachine\Time\Model;

class Date
{
    private $year;
    private $month;
    private $day;

    public function __construct($year, $month, $day)
    {
        $this->day   = (int) $day;
        $this->month = (int) $month;
        $this->year  = (int) $year;
    }

    public function during(Duration $duration)
    {
        $begin = new TimePoint($this->year, $this->month, $this->day, 0, 0);
        $end = $begin->plus($duration);

        return new DateInterval($begin->getDate(), $end->getDate());
    }

    public function isAfter(Date $date)
    {
        return
            $this->year > $date->getYear() ||
            ($this->year >= $date->getYear() && $this->month > $date->getMonth()) ||
            ($this->year >= $date->getYear() && $this->month >= $date->getMonth() && $this->day > $date->getDay())
        ;
    }

    public function isBefore(Date $date)
    {
        return !$this->isAfter($date);
    }

    public function isEquals(Date $date)
    {
        return
            $this->year === $date->getYear() &&
            $this->month === $date->getMonth() &&
            $this->day === $date->getDay()
        ;
    }

    public function beginOfWeek()
    {
        $i = 0;
        $curDate = $this;
        while ($i < 8) {
            $dtime = $curDate->toDateTime();
            $numOfWeek = (int)$dtime->format('N');
            if (1 === $numOfWeek) {
                return $curDate;
            }
            $curDate = $curDate->previous();
            $i = $i + 1;
        }
        throw new \RunTimeException('Loop error with begin of week');
    }

    public function next()
    {
        $date = $this->toDateTime();
        $date->add(new \DateInterval('P1D'));

        return new self($date->format('Y'), $date->format('m'), $date->format('d'));
    }

    public function previous()
    {
        $date = $this->toDateTime();
        $date->sub(new \DateInterval('P1D'));

        return new self($date->format('Y'), $date->format('m'), $date->format('d'));
    }

    public function toDateTime()
    {
        return (new \Datetime())->setDate($this->year, $this->month, $this->day);
    }

    public function toTimePoint()
    {
        return new TimePoint($this->year, $this->month, $this->day, null, null);
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
