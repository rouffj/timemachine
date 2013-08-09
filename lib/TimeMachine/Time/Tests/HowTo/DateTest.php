<?php

namespace TimeMachine\Time\Tests\HowTo;

use TimeMachine\Time\Model\Duration;
use TimeMachine\Time\Model\TimePoint;
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
        $this->assertTrue($this->date->isEquals($this->date));
    }

    public function testHowToConvertADddTimeDateObjectIntoRegularDateTimeObject()
    {
        $this->assertInstanceOf('\DateTime', $this->date->toDateTime());
    }

    public function testHowToKnowIfDateIsDuringWeekendOrWeekday()
    {
        $this->assertTrue($this->date->isWeekEndDay());
        $this->assertFalse($this->date->isWeekDay());

        $weekday = $this->date->plus(new Duration(3, TimeUnit::day()));

        $this->assertFalse($weekday->isWeekEndDay());
        $this->assertTrue($weekday->isWeekDay());
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

    /**
     * Use cases :
     *  - Calculate difference between 2 days
     *  - Fetch the position of a date from another
     *  - How many days form my birthday
     *
     * Returns a Duration Class @see TimeMachine\Time\Model\Duration.
     *
     */
    public function testHowToKnowDiffBetweenItAndAnOtherDate()
    {
        $date = new Date(2013, 2, 1);
        $diff = $this->date->diff($date);

        $this->assertInstanceOf('TimeMachine\Time\Model\Duration', $diff);
        $this->assertEquals($diff, new Duration(9, TimeUnit::day()));
    }

    public function testHowToKnowDiffBetweenItAndATimePoint()
    {
        $this->markTestIncomplete();
    }
}
