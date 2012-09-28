<?php

namespace TimeMachine\Tests\Time;

use TimeMachine\Time\Model\DateInterval;
use TimeMachine\Time\Model\Date;
use TimeMachine\Tests\TestCase;

class DateIntervalTest extends TestCase
{
    public function testGetLength()
    {
        $interval = new DateInterval(new Date(2012, 01, 01), new Date(2012, 01, 01));
        $this->assertEquals(1, $interval->getLength());

        $interval = new DateInterval(new Date(2012, 01, 01), new Date(2012, 01, 03));
        $this->assertEquals(3, $interval->getLength());
    }

    public function testNextEquals()
    {
        $startDate = new Date(2012, 01, 01);
        $endDate = new Date(2012, 01, 03);

        $interval = new DateInterval($startDate, $endDate);
        $this->assertEquals($startDate, $interval->getBegin());
        $this->assertEquals(new Date(2012, 01, 02), $interval->getBegin()->next());
        $this->assertEquals(new Date(2012, 01, 03), $interval->getBegin()->next()->next());

        $this->assertFalse($endDate->equals($interval->getBegin()));
        $this->assertFalse($endDate->equals($interval->getBegin()->next()));
        $this->assertTrue($endDate->equals($interval->getBegin()->next()->next()));
    }
}
