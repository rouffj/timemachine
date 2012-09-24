<?php

namespace Rouffj\Time\Domain\Model\Core;

class TimeInterval implements IntervalInterface
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

    public function isBefore(IntervalInterface $interval)
    {
        return $interval->getEnd()->greater($this->getBegin()) && $interval->getBegin()->greater($this->getEnd());
    }

    public function isAfter(IntervalInterface $interval)
    {
        return $this->begin->greater($interval->getEnd());
    }

    public function isDuring(IntervalInterface $interval)
    {
        return !$this->isBefore($interval) && !$this->isAfter($interval);
    }

    public function getBegin()
    {
        return $this->begin;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function getLength()
    {
        $begin = $this->begin->asPHPDateTime();
        $end = $this->end->asPHPDateTime();
        $diff = $begin->diff($end);

        return new Duration($diff->format('%H'), TimeUnit::hour());
    }
}
