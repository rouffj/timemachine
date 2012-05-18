<?php

namespace Rouffj\Tests\Time;

use Rouffj\Tests\TestCase;
use Rouffj\Time\CalendarDate;
use Rouffj\Time\TimePoint;
use Rouffj\Time\CalendarInterval;

/**
 * CalendarDate test case
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class CalendarDateTest extends TestCase
{
    public function __construct()
    {
        $this->feb17 = CalendarDate::from(2003, 2, 17);
        $this->mar13 = CalendarDate::from(2003, 3, 13);
        $this->ct = new \DateTimeZone("America/Chicago");
        $this->gmt = new \DateTimeZone("UTC");
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

/*
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


    public function testPreviousDay()
    {
        $mar1_2004 = CalendarDate::date(2004, 3, 1);
        $this->assertEquals(CalendarDate::date(2004, 2, 29), $mar1_2004->previousDay());
        $this->assertEquals(CalendarDate::date(2004, 2, 28), $mar1_2004->previousDay()->previousDay());
    }

    public function testMonth()
    {
        $nov6_2004 = CalendarDate::date(2004, 11, 6);
        $nov2004 = CalendarInterval::inclusive(2004, 11, 1, 2004, 11, 30);
        $this->assertEquals($nov2004, $nov6_2004->month());

        $dec6_2004 = CalendarDate::date(2004, 12, 6);
        $dec2004 = CalendarInterval::inclusive(2004, 12, 1, 2004, 12, 31);
        $this->assertEquals($dec2004, $dec6_2004->month());

        $feb9_2004 = CalendarDate::date(2004, 2, 9);
        $feb2004 = CalendarInterval::inclusive(2004, 2, 1, 2004, 2, 29);
        $this->assertEquals($feb2004, $feb9_2004->month());

        $feb9_2003 = CalendarDate::date(2003, 2, 9);
        $feb2003 = CalendarInterval::inclusive(2003, 2, 1, 2003, 2, 28);
        $this->assertEquals($feb2003, $feb9_2003->month());
    }

    public function testToString()
    {
        $date = CalendarDate::date(2004, 5, 28);
        $this->assertEquals("2004-5-28", $date->toString());
    }
*/
/*
    public function testConversionToJavaUtil() {
        Calendar expected = Calendar.getInstance(gmt);
        expected.set(Calendar.YEAR, 1969);
        expected.set(Calendar.MONTH, Calendar.JULY);
        expected.set(Calendar.DATE, 20);
        expected.set(Calendar.HOUR, 0);
        expected.set(Calendar.AM_PM, Calendar.AM);
        expected.set(Calendar.MINUTE, 0);
        expected.set(Calendar.SECOND, 0);
        expected.set(Calendar.MILLISECOND, 0);

        CalendarDate date = CalendarDate.from(1969, 7, 20);
        Calendar actual = date.asJavaCalendarUniversalZoneMidnight();
        assertEquals(expected.get(Calendar.HOUR), actual.get(Calendar.HOUR));
        assertEquals(expected.get(Calendar.AM_PM), actual.get(Calendar.AM_PM));
        assertEquals(expected.get(Calendar.HOUR_OF_DAY), actual.get(Calendar.HOUR_OF_DAY));
        assertEquals(expected, actual);
    }
*/
}
