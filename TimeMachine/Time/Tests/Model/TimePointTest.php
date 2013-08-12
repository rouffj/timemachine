<?php

namespace TimeMachine\Time\Tests\Model;

use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Time\Model\Duration;
use TimeMachine\Time\Model\TimeUnit;
use TimeMachine\Time\Model\TimeInterval;
use TimeMachine\Time\Tests\TestCase;

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

    public function testMinus()
    {
        $point = new TimePoint(2012, 1, 1, 9, 30);

        $this->assertEquals(new TimePoint(2009, 1, 1, 9, 30), $point->minus(new Duration(3, TimeUnit::year())));
        $this->assertEquals(new TimePoint(2011, 9, 1, 9, 30), $point->minus(new Duration(4, TimeUnit::month())));
        $this->assertEquals(new TimePoint(2011, 12, 30, 9, 30), $point->minus(new Duration(2, TimeUnit::day())));
        $this->assertEquals(new TimePoint(2012, 1, 1, 6, 30), $point->minus(new Duration(3, TimeUnit::hour())));
        $this->assertEquals(new TimePoint(2012, 1, 1, 9, 0), $point->minus(new Duration(30, TimeUnit::minute())));
    }

    public function testUntilDuring()
    {
        $point = new TimePoint(2012, 1, 1, 9, 30);

        $expectedInterval = new TimeInterval(new TimePoint(2012, 1, 1, 9, 30), new TimePoint(2012, 1, 1, 13, 30));
        $this->assertTrue($expectedInterval->isEquals($point->during(new Duration(4, TimeUnit::hour()))));
        $this->assertTrue($expectedInterval->isEquals($point->until(new TimePoint(2012, 1, 1, 13, 30))));
    }

    public function testGreater()
    {
        $point = new TimePoint(2012, 2, 1, 1, 0, 30);

        // second
        $this->assertTrue($point->isAfter(new TimePoint(2012, 2, 1, 1, 0, 29)));
        $this->assertFalse($point->isAfter(new TimePoint(2012, 2, 1, 1, 0, 30)));
        $this->assertFalse($point->isAfter(new TimePoint(2012, 2, 1, 1, 0, 31)));
    }
}
