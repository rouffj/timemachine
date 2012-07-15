<?php

namespace Rouffj\Tests\Time;

use Rouffj\Time\Core\CalendarInterval;
use Rouffj\Time\Core\CalendarDate;
use Rouffj\Tests\TestCase;

class CalendarDateTest extends TestCase
{
    public function testGreater()
    {
        $date = new CalendarDate(2012, 11, 2);
        $this->assertEquals(true, $date->greater(new CalendarDate(2011, 11, 25)));
        $this->assertEquals(true, $date->greater(new CalendarDate(2012, 10, 1)));
        $this->assertEquals(true, $date->greater(new CalendarDate(2012, 11, 1)));

        $this->assertEquals(false, $date->greater(new CalendarDate(2012, 11, 2)));
        $this->assertEquals(false, $date->greater(new CalendarDate(2012, 11, 5)));
        $this->assertEquals(false, $date->greater(new CalendarDate(2012, 12, 5)));
    }
}
