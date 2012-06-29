<?php

namespace Rouffj\Tests\Time;

use Rouffj\Time\Core\TimePoint;
use Rouffj\Time\Core\Duration;
use Rouffj\Time\Core\TimeUnit;
use Rouffj\Time\Core\TimeInterval;
use Rouffj\Tests\TestCase;

class TimeIntervalTest extends TestCase
{

    public function testLength()
    {
        $interval = new TimeInterval(new TimePoint(2012, 1, 1, 9, 30), new TimePoint(2012, 1, 1, 13, 30));
        $expectedDuration = new Duration(4, TimeUnit::hour());
        $this->assertEquals($expectedDuration, $interval->getLength());
    }
}
