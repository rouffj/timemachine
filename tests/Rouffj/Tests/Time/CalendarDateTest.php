<?php

namespace Rouffj\Tests\Time;

use TimeMachine\Time\Model\DateInterval;
use TimeMachine\Time\Model\Date;
use Rouffj\Tests\TestCase;

class DateTest extends TestCase
{
    public function testGreater()
    {
        $date = new Date(2012, 11, 2);
        $this->assertEquals(true, $date->greater(new Date(2011, 11, 25)));
        $this->assertEquals(true, $date->greater(new Date(2012, 10, 1)));
        $this->assertEquals(true, $date->greater(new Date(2012, 11, 1)));

        $this->assertEquals(false, $date->greater(new Date(2012, 11, 2)));
        $this->assertEquals(false, $date->greater(new Date(2012, 11, 5)));
        $this->assertEquals(false, $date->greater(new Date(2012, 12, 5)));
    }
}
