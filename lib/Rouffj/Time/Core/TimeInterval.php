<?php

namespace Rouffj\Time\Core;

class TimeInterval
{
    private $begin;
    private $end;

    public function __construct(TimePoint $beginTime, TimePoint $endTime)
    {
        $this->begin = $beginTime;
        $this->end = $endTime;
    }

    public function equals(TimeInterval $interval)
    {
        return
            $this->begin->equals($interval->getBegin()) &&
            $this->end->equals($interval->getEnd())
        ;
    }

    public function getBegin()
    {
        return $this->begin;
    }

    public function getEnd()
    {
        return $this->end;
    }
}
