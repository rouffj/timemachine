<?php

namespace Rouffj\Time\Factory;

use Rouffj\Time\Core\DateInterval;
use Rouffj\Time\Core\TimeInterval;
use Rouffj\Time\Core\TimePoint;

class TimeIntervalFactory
{
    static public function create($begin, $end)
    {
        $begin = \DateTime::createFromFormat('Y-m-d G:i', $begin);
        $end = \DateTime::createFromFormat('Y-m-d G:i', $end);

        return new TimeInterval(
            new TimePoint($begin->format('Y'), $begin->format('m'), $begin->format('d'), $begin->format('G'), $begin->format('i')),
            new TimePoint($end->format('Y'), $end->format('m'), $end->format('d'), $end->format('G'), $end->format('i'))
        );
    }

    static public function fromDateInterval(DateInterval $dateInterval)
    {
        $begin = $dateInterval->getBegin();
        $end = $dateInterval->getEnd();

        return new TimeInterval(
            new TimePoint($begin->getYear(), $begin->getMonth(), $begin->getDay(), 0, 0),
            new TimePoint($end->getYear(), $end->getMonth(), $end->getDay(), 23, 59, 59)
        );
    }
}

