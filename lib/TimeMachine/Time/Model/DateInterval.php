<?php

namespace TimeMachine\Time\Model;

class DateInterval implements IntervalInterface
{
    private $begin;
    private $current;
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
        return false === $this->current->isAfter($this->end);
    }

    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Get duration in days separating the begin and end date of DateInterval.
     *
     * @return Duration Expressed in days.
     */
    public function getDuration()
    {
        $begin = clone $this->begin;
        $duration = 1;
        while (false === $this->end->isEquals($begin)) {
            $begin = $begin->next();
            $duration = $duration + 1;
        }

        return new Duration($duration, TimeUnit::day());
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

    public function isBefore(IntervalInterface $other)
    {
        return $this->begin->isBefore($other->getBegin()) && $this->begin->isBefore($other->getEnd());
    }

    public function isAfter(IntervalInterface $other)
    {
        return $this->begin->isAfter($other->getBegin()) && $this->begin->isAfter($other->getEnd());
    }

    public function isDuring(IntervalInterface $other)
    {
        return
            $this->begin === max($this->begin, $other->getBegin()) &&
            $this->end === min($this->end, $other->getEnd())
        ;
    }

    public function isPartiallyBefore(IntervalInterface $interval)
    {
        throw new \Exception('Not implemented');
    }

    public function isPartiallyAfter(IntervalInterface $interval)
    {
        throw new \Exception('Not implemented');
    }
}

