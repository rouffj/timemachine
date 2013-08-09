<?php

namespace TimeMachine\Time\Tests\Model;

use TimeMachine\Time\Model\DateInterval;
use TimeMachine\Time\Model\Date;
use TimeMachine\Time\Model\Duration;
use TimeMachine\Time\Model\TimeUnit;
use TimeMachine\Time\Tests\TestCase;

class DateIntervalTest extends TestCase
{
    public function testGetDuration()
    {
        $interval = new DateInterval(new Date(2012, 01, 01), new Date(2012, 01, 01));
        $this->assertEquals(new Duration(0, TimeUnit::day()), $interval->getDuration());

        $interval = new DateInterval(new Date(2012, 01, 01), new Date(2012, 01, 03));
        $this->assertEquals(new Duration(2, TimeUnit::day()), $interval->getDuration());
    }

    public function testNextEquals()
    {
        $startDate = new Date(2012, 01, 01);
        $endDate = new Date(2012, 01, 03);

        $interval = new DateInterval($startDate, $endDate);
        $this->assertEquals($startDate, $interval->getBegin());
        $this->assertEquals(new Date(2012, 01, 02), $interval->getBegin()->next());
        $this->assertEquals(new Date(2012, 01, 03), $interval->getBegin()->next()->next());

        $this->assertFalse($endDate->isEquals($interval->getBegin()));
        $this->assertFalse($endDate->isEquals($interval->getBegin()->next()));
        $this->assertTrue($endDate->isEquals($interval->getBegin()->next()->next()));
    }
}
