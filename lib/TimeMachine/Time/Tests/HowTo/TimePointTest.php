<?php

namespace TimeMachine\Time\Tests\HowTo;

use TimeMachine\Time\Tests\TestCase;
use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Time\Model\Duration;
use TimeMachine\Time\Model\TimeUnit;

class TimePointTest extends TestCase
{
    public function testHowToKnowIfItIsBeforeAfterEqualAnOtherTimePoint()
    {
        $first = new TimePoint(2013, 3, 12, 18, 27);
        $second = new TimePoint(2013, 6, 23, 6, 31, 11);
        $third = new TimePoint(2013, 6, 23, 6, 31, 11);

        $this->assertEquals($second->isAfter($first), true);
        $this->assertEquals($second->isBefore($third), false);
        $this->assertEquals($first->isAfter($second), false);
        $this->assertEquals($third->equals($second), true);
    }

    public function testHowToKnowIfAItIsBbeforeAfterEqualAGivenDate()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfAItIsBbeforeAfterEqualAGivenDateInterval()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfAItIsBbeforeAfterEqualAGivenTimeInterval()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfItIsDuringNightOrDaylight()
    {
        $this->markTestIncomplete();
    }

    public function testHowToAddRemoveDurationFromIt()
    {
        $startTimePoint = new TimePoint(2013, 3, 12, 18, 27);
        $stopTimePoint = new TimePoint(2013, 3, 14, 18, 27);
        $duration = new Duration(2, TimeUnit::day());
        $result = $startTimePoint->plus($duration);
        $this->assertEquals($result, $stopTimePoint);
    }

    public function testHowToConvertADddTimePointObjectIntoRegularDateTimeobject()
    {
        $timepoint = new TimePoint(2013, 3, 12, 18, 27, 11);
        $datetime = new \DateTime();
        $datetime->setDate(2013, 3, 12);
        $datetime->setTime(18, 27, 11);
        $this->assertEquals($timepoint->toDateTime(), $datetime);
    }
}
