<?php

namespace TimeMachine\Time\Tests\HowTo;

use TimeMachine\Time\Model\Duration;
use TimeMachine\Time\Model\TimeUnit;
use TimeMachine\Time\Tests\TestCase;
use TimeMachine\Time\Model\Date;

class DateTest extends TestCase
{
    /**
     * @var Date
     */
    protected $date;

    public function setUp()
    {
        $this->date = new Date(2013, 2, 10);
    }

    public function testHowToCreateADateOnly()
    {
        $this->assertInstanceOf('TimeMachine\Time\Model\Date', $this->date);
    }

    public function testHowToComeBackAtBeginOfCurrentWeek()
    {
        $date = new Date(2013, 1, 4);
        $begin = $date->beginOfWeek();

        $this->assertEquals(new Date(2012, 12, 31), $begin);
    }

    public function testHowToKnowIfADateIsAfterBeforeEqualToAnOther()
    {
        $this->assertTrue($this->date->isBefore(new Date(2013, 3, 1)));
        $this->assertTrue($this->date->isAfter(new Date(2011, 3, 1)));
        $this->assertTrue($this->date->equals($this->date));
    }

    public function testHowToConvertADddTimeDateObjectIntoRegularDateTimeObject()
    {
        $this->assertInstanceOf('\DateTime', $this->date->toDateTime());
    }

    public function testHowToKnowIfDateIsDuringWeekendOrWeekday()
    {
        $this->markTestIncomplete();
    }

    public function testHowToGetPreviousNextDate()
    {
        $next     = $this->date->next();
        $previous = $this->date->previous();

        $this->assertEquals($next, new Date(2013, 2, 11));
        $this->assertEquals($previous, new Date(2013, 2,9));
    }

    public function testHowToAddRemoveADurationFromItCanReturnDateOrTimePoint()
    {
        $daysBefore = $this->date->minus(new Duration(1, TimeUnit::day()));
        $daysAfter  = $this->date->plus(new Duration(2, TimeUnit::day()));

        $this->assertEquals($daysBefore, new Date(2013, 2, 9));
        $this->assertEquals($daysAfter, new Date(2013, 2, 12));
    }

    public function testHowToTransformADateIntoATimePoint()
    {
        $timePoint = $this->date->toTimePoint();

        $this->assertInstanceOf('TimeMachine\Time\Model\TimePoint', $timePoint);
        $this->assertEquals($timePoint->getYear(), 2013);
        $this->assertEquals($timePoint->getMonth(), 2);
        $this->assertEquals($timePoint->getDay(), 10);
    }

    public function testHowToKnowThePositionInDaysWeeksMonthsYearsSinceAnOtherDate()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowDiffBetweenItAndAnOtherDate()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowDiffBetweenItAndATimePoint()
    {
        $this->markTestIncomplete();
    }
}
