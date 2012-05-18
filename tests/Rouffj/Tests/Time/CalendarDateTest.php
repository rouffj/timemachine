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
        $this->gmt = new \DateTimeZone("Universal");
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

        $this->assertEquals("2/17/2003", $feb17->toString("M/d/yyyy"));
        //Now a nonsense pattern, to make sure it isn't succeeding by accident.
        $this->assertEquals("#17-03/02 2003", $feb17->toString("#d-yy/MM yyyy"));
    }

    public function testFromFormattedString()
    {
        $feb17 = $this->feb17;

        $this->assertEquals($feb17, CalendarDate::from("2/17/2003", "M/d/yyyy"));
        //Now a nonsense pattern, to make sure it isn't succeeding by accident.
        $this->assertEquals($feb17, CalendarDate::from("#17-03/02 2003", "#d-yy/MM yyyy"));
    }

    public function testFromTimePoint()
    {
        $feb18Hour0Ct = TimePoint::atMidnight(2003, 2, 18, $this->gmt);
        $mapped = CalendarDate::from($feb18Hour0Ct, $this->ct);
        $this->assertEquals(CalendarDate::from(2003, 2, 17), $mapped);
    }

    public function testIncludes()
    {
        $feb17 = $this->feb17;
        $mar13 = $this->mar13;

        $this->assertTrue($feb17->equals($feb17));
        $this->assertFalse($feb17->equals($mar13));
    }

    public function testDayOfWeek()
    {
        $date = CalendarDate::date(2004, 11, 6);
        $this->assertEquals(CalendarDate::SATURDAY, $date->dayOfWeek());
        $date = CalendarDate::date(2007, 1, 1);
        $this->assertEquals(CalendarDate::MONDAY, $date->dayOfWeek());
    }

    public function testNextDay()
    {
        $feb28_2004 = CalendarDate::date(2004, 2, 28);
        $this->assertEquals(CalendarDate::date(2004, 2, 29), $feb28_2004->nextDay());
        $this->assertEquals(CalendarDate::date(2004, 3, 1), $feb28_2004->nextDay()->nextDay());
    }
}
