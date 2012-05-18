<?php
namespace Rouffj\Tests\Time;

use Rouffj\Tests\TestCase;
use Rouffj\Time\TimePoint;
use DateTimeZone;

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

        $this->gmt  = new DateTimeZone("Universal");
        $this->pt   = new DateTimeZone("America/Los_Angeles");
        $this->ct   = new DateTimeZone("America/Chicago");

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
        $excpected = TimePoint::atGMT(2004, 1, 1, 0, 0, 0, 0);

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

    }

    public function testAsJavaUtilDate()
    {

    }

    public function testBackToMidnight()
    {

    }

    public function testFromString()
    {

    }

    public function testEquals()
    {

    }

    public function testEqualsOverYearMonthDay()
    {

    }

    public function testBeforeAfter()
    {

    }

    public function testIncrementDuration()
    {

    }

    public function testDecrementDuration()
    {

    }

    public function testBeforeAfterPeriod()
    {

    }

    public function testNextDay()
    {

    }

    public function testCompare()
    {

    }

    public function testPotentialProblemDueToOldUsageOf_Duration_toBaseUnitsUsage()
    {

    }

    public function testNotIgnoringMinuteParameter()
    {

    }

    public function testAtWithTimeZone()
    {

    }
}