<?php

namespace Rouffj\Time\Factory;

use Rouffj\Time\Core\TimeUnit;
use Rouffj\Time\Core\Duration;

class DurationFactory
{
    static public function year($value)
    {
        return Duration($value, TimeUnit::year());
    }

    static public function month($value)
    {
        return Duration($value, TimeUnit::month());
    }

    //static public function complexe($year, $month, $day, $hour, $minute, $second)
    //{
    //    //$duration = new Duration($year, TimeUnit::year());
    //    //$duration->plus(new Duration($month, TimeUnit::month()));
    //}
}
