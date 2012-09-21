<?php

namespace Rouffj\Time\Factory;

use Rouffj\Time\Core\DateInterval;
use Rouffj\Time\Core\TimeInterval;
use Rouffj\Time\Core\TimePoint;

class TimeIntervalFactoryFactory
{
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

