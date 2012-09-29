<?php

namespace TimeMachine\Time\Factory;

use TimeMachine\Time\Model\TimeUnitInterval;
use TimeMachine\Time\Model\TimeUnit;
use TimeMachine\Time\Model\TimePoint;

class TimeUnitIntervalFactory
{
    static public function containing(TimePoint $point, TimeUnit $unit)
    {
        return new TimeUnitInterval($unit, self::buildIndex($point, $unit));
    }

    static public function rangeContaining(TimePoint $begin, TimePoint $end, TimeUnit $unit)
    {
        $beginIndex = self::buildIndex($begin, $unit);
        $endIndex   = self::buildIndex($end, $unit);

        $range = array();
        for ($index = $beginIndex; $index <= $endIndex; $index++) {
            $range[] = new TimeUnitInterval($unit, $index);
        }

        return $range;
    }

    static private function buildIndex(TimePoint $point, TimeUnit $unit)
    {
        $origin   = new \DateTime(TimeUnitInterval::ORIGIN);
        $property = $unit->getIntervalProperty();
        $interval = $origin->diff($point->asPHPDateTime());

        return $interval->$property;
    }
}

