<?php
namespace Rouffj\Tests\Time;

use Rouffj\Tests\TestCase;
use Rouffj\Time\TimePoint;
use Rouffj\Time\TimeInterval;
use Rouffj\Time\Calendar;
use Rouffj\Time\Duration;

/**
* 
* @author Julien Galenski <julien.galenski@gmail.com>
*/
class TimePointTest extends TestCase
{
    const AM = "AM";
    const PM = "PM";

    protected $gmt;
    protected $pt;
    protected $ct;

    protected $dec19_2003;
    protected $dec20_2003;
    protected $dec21_2003;
    protected $dec22_2003;

    public function setup()
    {
        parent::setup();

        $this->gmt  = new \DateTimeZone("UTC");
        $this->pt   = new \DateTimeZone("America/Los_Angeles");
        $this->ct   = new \DateTimeZone("America/Chicago");

        $this->dec19_2003 = TimePoint::atMidnightGMT(2003, 12, 19);
        $this->dec20_2003 = TimePoint::atMidnightGMT(2003, 12, 20);
        $this->dec21_2003 = TimePoint::atMidnightGMT(2003, 12, 21);
        $this->dec22_2003 = TimePoint::atMidnightGMT(2003, 12, 22);
    }

    public function testSerialization()
    {

    }

    public function testCreationWithDefaultTimeZone()
    {
        $expected = TimePoint::atGMT(2004, 1, 1, 0, 0, 0, 0);

        $this->assertEquals($expected, TimePoint::atMidnightGMT(2004, 1, 1), "at midnight");
        $this->assertEquals($expected, TimePoint::atGMT(2004, 1, 1, 0, 0), "hours in 24hr clock");
        $this->assertEquals($expected, TimePoint::at12hr(2004, 1, 1, 12, self::AM, 0, 0, 0, $this->gmt), "hours in 12hr clock");
        $this->assertEquals($expected, TimePoint::parseGMTFrom("2004/1/1", "yyyy/MM/dd"), "date from formatted String");
        $this->assertEquals(TimePoint::atGMT(2004, 1, 1, 12, 0), TimePoint::at12hr(2004, 1, 1, 12, self::PM, 0, 0, 0, $this->gmt), "pm hours in 12hr clock");
    }

    public function testCreationWithTimeZone()
    {
        $gmt10Hour = TimePoint::at(2004, 3, 5, 10, 10, 0, 0, $this->gmt);
        $default10Hour = TimePoint::atGMT(2004, 3, 5, 10, 10, 0, 0);
        $pt2Hour = TimePoint::at(2004, 3, 5, 2, 10, 0, 0, $this->pt);

        $this->assertEquals($gmt10Hour, $default10Hour);
        $this->assertEquals($gmt10Hour, $pt2Hour);

        $gmt6Hour = TimePoint::at(2004, 3, 5, 6, 0, 0, 0, $this->gmt);
        $ct0Hour = TimePoint::at(2004, 3, 5, 0, 0, 0, 0, $this->ct);
        $ctMidnight = TimePoint::atMidnight(2004, 3, 5, $this->ct);
        $this->assertEquals($gmt6Hour, $ct0Hour);
        $this->assertEquals($gmt6Hour, $ctMidnight);
    }

    public function testStringFormat()
    {
        $point = TimePoint::at(2004, 3, 12, 5, 3, 14, 0, $this->pt);
        // Try stupid date/time format, so that it couldn't work by accident.
        $this->assertEquals("3-04-12 3:5:14", $point->toString("M-yy-d m:h:s", $this->pt));
        $this->assertEquals("3-04-12", $point.toString("M-yy-d", $this->pt));
    }

    public function javaUtilDateDec20_2003() {
        $calendar = new \DateTime('', $this->gmt);
        $calendar->setDate(2003, 12, 20);

        return $calendar;
    }

    public function testAsJavaUtilDate()
    {
        $dec20_2003 = TimePoint::atMidnightGMT(2003, 12, 20);
        $this->assertEquals($this->javaUtilDateDec20_2003(), $dec20_2003->asJavaUtilDate());
    }

    public function testBackToMidnight()
    {
        $threeOClock = TimePoint::atGMT(2004, 11, 22, 3, 0);
        $this->assertEquals(TimePoint::atMidnightGMT(2004, 11, 22), $threeOClock->backToMidnight($this->gmt));
        $thirteenOClock = TimePoint::atGMT(2004, 11, 22, 13, 0);
        $this->assertEquals(TimePoint::atMidnightGMT(2004, 11, 22), $thirteenOClock->backToMidnight($this->gmt));
    }

    public function testFromString()
    {
        $expected = TimePoint::atGMT(2004, 3, 29, 22, 44, 58, 0);
        $source = "2004-Mar-29 10:44:58 PM";
        $pattern = "yyyy-MMM-dd hh:mm:ss a";
        $this->assertEquals($expected, TimePoint::parseGMTFrom($source, $pattern));
    }

    public function testEquals()
    {
        $createdFromJavaDate = TimePoint::from($this->javaUtilDateDec20_2003());
        $dec5_2003 = TimePoint::atMidnightGMT(2003, 12, 5);
        $dec20_2003 = TimePoint::atMidnightGMT(2003, 12, 20);
        $this->assertEquals($createdFromJavaDate, $dec20_2003);
        $this->assertTrue($createdFromJavaDate->equals($dec20_2003));
        $this->assertFalse($createdFromJavaDate->equals($dec5_2003));
    }

    public function testEqualsOverYearMonthDay()
    {
        $thePoint = TimePoint::atGMT(2000, 1, 1, 8, 0);
        $gmt = new \DateTimeZone("UTC");

        $this->assertTrue(TimePoint::atGMT(2000, 1, 1, 8, 0)->isSameDayAs($thePoint, $gmt), "exactly the same");
        $this->assertTrue(TimePoint::atGMT(2000, 1, 1, 8, 0, 0, 500)->isSameDayAs($thePoint, $gmt), "same second");
        $this->assertTrue(TimePoint::atGMT(2000, 1, 1, 8, 0, 30, 0)->isSameDayAs($thePoint, $gmt), "same minute");
        $this->assertTrue(TimePoint::atGMT(2000, 1, 1, 8, 30, 0, 0)->isSameDayAs($thePoint, $gmt), "same hour");
        $this->assertTrue(TimePoint::atGMT(2000, 1, 1, 20, 0)->isSameDayAs($thePoint, $gmt), "same day");
        $this->assertTrue(TimePoint::atMidnightGMT(2000, 1, 1)->isSameDayAs($thePoint, $gmt), "midnight (in the moring), start of same day");

        $this->assertFalse(TimePoint::atMidnightGMT(2000, 1, 2)->isSameDayAs($thePoint, $gmt), "midnight (night), start of next day");
        $this->assertFalse(TimePoint::atGMT(2000, 1, 2, 8, 0)->isSameDayAs($thePoint, $gmt), "next day");
        $this->assertFalse(TimePoint::atGMT(2000, 2, 1, 8, 0)->isSameDayAs($thePoint, $gmt), "next month");
        $this->assertFalse(TimePoint::atGMT(2001, 1, 1, 8, 0)->isSameDayAs($thePoint, $gmt), "next year");
    }

    public function testBeforeAfter()
    {
        $dec5_2003 = TimePoint::atMidnightGMT(2003, 12, 5);
        $dec20_2003 = TimePoint::atMidnightGMT(2003, 12, 20);
        $this->assertTrue($dec5_2003->isBefore($dec20_2003));
        $this->assertFalse($dec20_2003->isBefore($dec20_2003));
        $this->assertFalse($dec20_2003->isBefore($dec5_2003));
        $this->assertFalse($dec5_2003->isAfter($dec20_2003));
        $this->assertFalse($dec20_2003->isAfter($dec20_2003));
        $this->assertTrue($dec20_2003->isAfter($dec5_2003));

        $oneSecondLater = TimePoint::atGMT(2003, 12, 20, 0, 0, 1, 0);
        $this->assertTrue($dec20_2003->isBefore($oneSecondLater));
        $this->assertFalse($dec20_2003->isAfter($oneSecondLater));
    }

    public function testIncrementDuration()
    {
        $twoDays = Duration::days(2);
        $this->assertEquals($this->dec22_2003, $this->dec20_2003->plus($twoDays));
    }

    public function testDecrementDuration()
    {
        $twoDays = Duration::days(2);
        $this->assertEquals($this->dec19_2003, $this->dec21_2003->minus($twoDays));
    }

    public function testBeforeAfterPeriod()
    {
        $period = TimeInterval::closed($this->dec20_2003, $this->dec22_2003);
        $this->assertTrue($this->dec19_2003->isBeforeInterval($period));
        $this->assertFalse($this->dec19_2003->isAfterInterval($period));
        $this->assertFalse($this->dec20_2003->isBeforeInterval($period));
        $this->assertFalse($this->dec20_2003->isAfterInterval($period));
        $this->assertFalse($this->dec21_2003->isBeforeInterval($period));
        $this->assertFalse($this->dec21_2003->isAfterInterval($period));
    }

    public function testNextDay()
    {
        $this->assertEquals($this->dec20_2003, $this->dec19_2003->nextDay());
    }

    public function testCompare()
    {
        $this->assertTrue($this->dec19_2003->compareTo($this->dec20_2003) < 0);
        $this->assertTrue($this->dec20_2003->compareTo($this->dec19_2003) > 0);
        $this->assertTrue($this->dec20_2003->compareTo($this->dec20_2003) == 0);
    }

    public function testPotentialProblemDueToOldUsageOf_Duration_toBaseUnitsUsage()
    {
        $start = TimePoint::atGMT(2005, 10, 1, 0, 0);
        $end1 = $start->plus(Duration::days(24));
        $end2 = $start->plus(Duration::days(25));
        $this->assertTrue($start->isBefore($end1), "Start timepoint is before end1");
        $this->assertTrue($start->isBefore($end2), "and should of course be before end2");
    }

    public function testNotIgnoringMinuteParameter()
    {
        $point = TimePoint::at(2006, 03, 22, 13, 45, 59, 499, $this->gmt);
        $this->assertEquals("2006-03-22 13:45:59:499", $point->toString("yyyy-MM-dd HH:mm:ss:SSS", $this->gmt));
        $pointNoMilli = TimePoin::at(2006, 03, 22, 13, 45, 59, $this->gmt);
        $this->assertEquals("2006-03-22 13:45:59:000", $pointNoMilli->toString("yyyy-MM-dd HH:mm:ss:SSS", $this->gmt));
    }

    public function testAtWithTimeZone()
    {
        $someTime = TimePoint::at(2006, 6, 8, 16, 45, 33, 0, new \DateTimeZone('UTC'));
        $someTimeAsJavaCalendar = $someTime->asJavaCalendar(new \DateTimeZone('UTC'));

        $this->assertEquals(2006, $someTimeAsJavaCalendar->format('Y'));
        $this->assertEquals(6, $someTimeAsJavaCalendar->format('m'));
        $this->assertEquals(8, $someTimeAsJavaCalendar->format('d'));
        $this->assertEquals(16, $someTimeAsJavaCalendar->format('h'));
        $this->assertEquals(45, $someTimeAsJavaCalendar->format('i'));
        $this->assertEquals(33, $someTimeAsJavaCalendar->format('s'));
    }
}