<?php

namespace Rouffj\Tests\Time;

use Rouffj\Time\Core\CalendarInterval;
use Rouffj\Time\Core\CalendarDate;
use Rouffj\Tests\TestCase;

class CalendarIntervalTest extends TestCase
{
    public function testGetLength()
    {
        $interval = new CalendarInterval(new CalendarDate(2012, 01, 01), new CalendarDate(2012, 01, 01));
        $this->assertEquals(1, $interval->getLength());

        $interval = new CalendarInterval(new CalendarDate(2012, 01, 01), new CalendarDate(2012, 01, 03));
        $this->assertEquals(3, $interval->getLength());
    }

    public function testNextEquals()
    {
        $startDate = new CalendarDate(2012, 01, 01);
        $endDate = new CalendarDate(2012, 01, 03);

        $interval = new CalendarInterval($startDate, $endDate);
        $this->assertEquals($startDate, $interval->getBegin());
        $this->assertEquals(new CalendarDate(2012, 01, 02), $interval->getBegin()->next());
        $this->assertEquals(new CalendarDate(2012, 01, 03), $interval->getBegin()->next()->next());

        $this->assertFalse($endDate->equals($interval->getBegin()));
        $this->assertFalse($endDate->equals($interval->getBegin()->next()));
        $this->assertTrue($endDate->equals($interval->getBegin()->next()->next()));
    }
}
