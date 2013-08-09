<?php

namespace TimeMachine\Time\Tests\HowTo;

use TimeMachine\Time\Tests\TestCase;
use TimeMachine\Time\Model\DateInterval;
use TimeMachine\Time\Model\Date;
use TimeMachine\Time\Model\TimeUnit;
use TimeMachine\Time\Model\Duration;

class DateIntervalTest extends TestCase
{
    public function testHowToGetNumberOfDaysBetween2Dates()
    {
        $interval = new DateInterval(new Date(2013, 1, 1), new Date(2013, 1, 20));
        $duration = $interval->getDuration();

        $this->assertEquals(new Duration(20, TimeUnit::day()), $duration);
    }

    public function testHowToGetNumberOfHoursBetween2Dates()
    {
        $this->markTestIncomplete();
    }

    public function testHowToGetNumberOfMinutesBetween2Dates()
    {
        $this->markTestIncomplete();
    }

    public function testHowToGetNumberOfSecondsBetween2Dates()
    {
        $this->markTestIncomplete();
    }

    public function testHowToGetEachDayBetween2Dates()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfADateIntervalIsBeforeAfterDuringOtherDateInterval()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfADateIntervalIsBeforeAfterDuringAGivenDate()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfADateIntervalIsBeforeAfterDuringAGivenTimeInterval()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfADateIntervalIsBeforeAfterDuringAGivenTimePoint()
    {
        $this->markTestIncomplete();
    }

    public function testHowToTranformDateIntervalIntoTimeInterval()
    {
        $this->markTestIncomplete();
    }
}
