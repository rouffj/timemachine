<?php

namespace TimeMachine\Time\Tests\Model;

use TimeMachine\Time\Model\Date;
use TimeMachine\Time\Tests\TestCase;

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
