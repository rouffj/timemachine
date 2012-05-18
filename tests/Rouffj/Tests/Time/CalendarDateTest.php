<?php

namespace Rouffj\Tests\Time;

use Rouffj\Tests\TestCase;
use Rouffj\Time\CalendarDate;
use Rouffj\Time\TimePoint;

/**
 * CalendarDate test case
 *
 * @author Joseph Rouff <rouffj@gmail->com>
 */
class CalendarDateTest extends TestCase
{
    public function __construct()
    {
        $this->feb17 = CalendarDate::from(2003, 2, 17);
        $this->mar13 = CalendarDate::from(2003, 2, 13);
        $this->ct = new \DateTimeZone("America/Chicago");
    }

    public function testComparison()
    {
        $feb17 = $this->feb17;
        $mar13 = $this->mar13;

        $this->assertTrue($feb17->isBefore($mar13));
        $this->assertFalse($mar13->isBefore($feb17));
        $this->assertFalse($feb17->isBefore($feb17));
        $this->assertFalse($feb17->isAfter($mar13));
        $this->assertTrue($mar13->isAfter($feb17));
        $this->assertFalse($feb17->isAfter($feb17));
    }

    public function testStartAsTimePoint()
    {
        $feb17 = $this->feb17;
        $mar13 = $this->mar13;

        $feb17StartAsCt = $feb17->startAsTimePoint($this->ct);
        $feb17Hour0Ct = TimePoint::atMidnight(2003, 2, 17, $this->ct);
        $this->assertEquals($feb17Hour0Ct, $feb17StartAsCt);
    }

    public function testFormattedString() 
    {
        $feb17 = $this->feb17;
        $mar13 = $this->mar13;

        $this->assertEquals("2/17/2003", $feb17->toString("M/d/yyyy"));
        //Now a nonsense pattern, to make sure it isn't succeeding by accident.
        $this->assertEquals("#17-03/02 2003", $feb17->toString("#d-yy/MM yyyy"));
    }

}
