<?php

namespace Rouffj\Tests\Time;

use Rouffj\Time\TimePoint;
use Rouffj\Time\Duration;
use Rouffj\Time\TimeUnit;
use Rouffj\Tests\TestCase;

class TimePointTest extends TestCase
{
    public function testPlus()
    {
        $point = new TimePoint(2012, 1, 1, 9, 30);
        $this->assertEquals(new TimePoint(2015, 1, 1, 9, 30), $point->plus(new Duration(3, TimeUnit::year())));
        $this->assertEquals(new TimePoint(2012, 5, 1, 9, 30), $point->plus(new Duration(4, TimeUnit::month())));
        $this->assertEquals(new TimePoint(2012, 1, 3, 9, 30), $point->plus(new Duration(2, TimeUnit::day())));
        $this->assertEquals(new TimePoint(2012, 1, 1, 12, 30), $point->plus(new Duration(3, TimeUnit::hour())));
        $this->assertEquals(new TimePoint(2012, 1, 1, 10, 0), $point->plus(new Duration(30, TimeUnit::minute())));
    }
}
