<?php

namespace TimeMachine\Time\Factory;

use TimeMachine\Time\Model\TimeUnit;

/**
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class TimeUnitFactory
{
    static public function year()
    {
        return new TimeUnit(TimeUnit::YEAR);
    }

    static public function month()
    {
        return new TimeUnit(TimeUnit::MONTH);
    }

    static public function week()
    {
        return new TimeUnit(TimeUnit::WEEK);
    }

    static public function day()
    {
        return new TimeUnit(TimeUnit::DAY);
    }

    static public function hour()
    {
        return new TimeUnit(TimeUnit::HOUR);
    }

    static public function minute()
    {
        return new TimeUnit(TimeUnit::MINUTE);
    }

    static public function second()
    {
        return new TimeUnit(TimeUnit::SECOND);
    }
}
