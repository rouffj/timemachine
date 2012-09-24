<?php

namespace Rouffj\Tests\Time;

use Rouffj\Time\Core\TimePoint;
use Rouffj\Time\Core\Duration;
use Rouffj\Time\Core\TimeUnit;
use Rouffj\Time\Core\TimeInterval;
use Rouffj\Tests\TestCase;
use Rouffj\Time\Factory\TimeIntervalFactory;

class TimeIntervalTest extends TestCase
{

    public function testLength()
    {
        $interval = new TimeInterval(new TimePoint(2012, 1, 1, 9, 30), new TimePoint(2012, 1, 1, 13, 30));
        $expectedDuration = new Duration(4, TimeUnit::hour());
        $this->assertEquals($expectedDuration, $interval->getLength());
    }

    public function testIsBefore()
    {
        $interval = TimeIntervalFactory::create('2012-01-01 20:00', '2012-01-01 21:59');
        $intervalA = TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 19:59'); // is before
        $intervalB = TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 20:10'); // is not before

        $this->assertFalse($interval->isBefore($intervalA));
        $this->assertTrue($intervalA->isBefore($interval));
        $this->assertFalse($intervalB->isBefore($interval));
        $this->assertFalse($interval->isBefore($intervalB));
        //TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 20:00'); // is before
        //TimeIntervalFactory::create('2012-01-01 22:00', '2012-01-01 22:30'); // is after
        //TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 21:30'); // is during
        //TimeIntervalFactory::create('2012-01-01 21:30', '2012-01-01 22:30'); // is during
        //TimeIntervalFactory::create('2012-01-01 15:00', '2012-01-01 23:00'); // is during?
    }

    public function testIsAfter()
    {
        $interval = TimeIntervalFactory::create('2012-01-01 20:00', '2012-01-01 21:59');
        $intervalA = TimeIntervalFactory::create('2012-01-01 22:00', '2012-01-01 22:30'); // is after

        $this->assertFalse($interval->isAfter($intervalA));
        $this->assertTrue($intervalA->isAfter($interval));
    }

    public function testIsDuring()
    {
        $interval = TimeIntervalFactory::create('2012-01-01 20:00', '2012-01-01 21:59');
        $intervalA = TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 21:30'); // is during
        $intervalB = TimeIntervalFactory::create('2012-01-01 21:30', '2012-01-01 22:30'); // is during
        $intervalC = TimeIntervalFactory::create('2012-01-01 15:00', '2012-01-01 23:00'); // is during?

        $this->assertTrue($interval->isDuring($intervalA));
        $this->assertTrue($intervalA->isDuring($interval));

        $this->assertTrue($interval->isDuring($intervalB));
        $this->assertTrue($intervalB->isDuring($interval));

        $this->assertTrue($interval->isDuring($intervalC));
        $this->assertTrue($intervalC->isDuring($interval));
    }
}
