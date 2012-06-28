<?php

namespace Rouffj\Time;

class CalendarInterval
{
    private $begin;
    private $end;

    public function __construct(CalendarDate $beginDate, CalendarDate $endDate)
    {
        $this->begin = $beginDate;
        $this->end = $endDate;
    }

    public function getLength()
    {
        $begin = clone $this->begin;
        $duration = 1;
        while (false === $this->end->equals($begin)) {
            $begin = $begin->next();
            $duration = $duration + 1;
        }

        return $duration;
    }

    /**
     * Gets the value of begin
     *
     * @return 
     */
    public function getBegin()
    {
        return $this->begin;
    }
}

