<?php

namespace Rouffj\Time\Facade;

use Rouffj\Time\Core\Duration;

class Duration extends BaseDuration
{
    static public function year($value)
    {
        return self($value, TimeUnit::year());
    }

    static public function month($value)
    {
        return self($value, TimeUnit::month());
    }

    //static public function complexe($year, $month, $day, $hour, $minute, $second)
    //{
    //    //$duration = new Duration($year, TimeUnit::year());
    //    //$duration->plus(new Duration($month, TimeUnit::month()));
    //}
}
