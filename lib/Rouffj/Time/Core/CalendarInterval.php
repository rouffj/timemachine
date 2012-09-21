<?php

namespace Rouffj\Time\Core;

class CalendarInterval
{
    private $begin;
    private $end;

    public function __construct(Date $beginDate, Date $endDate)
    {
        $this->begin = $beginDate;
        $this->end = $endDate;
        $this->current = $this->begin;
    }

    public function nextDate()
    {
        $this->current = $this->current->next();
        return false === $this->current->greater($this->end);
    }

    public function getCurrent()
    {
        return $this->current;
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

    public function getEnd()
    {
        return $this->end;
    }
}

