<?php

namespace TimeMachine\Time\Tests\HowTo;

use TimeMachine\Time\Tests\TestCase;
use TimeMachine\Time\Model\Date;

class DateTest extends TestCase
{
    public function testHowToCreateADateOnly()
    {
        $this->markTestIncomplete();
    }

    public function testHowToComeBackAtBeginOfCurrentWeek()
    {
        $date = new Date(2013, 1, 4);
        $begin = $date->beginOfWeek();

        $this->assertEquals(new Date(2012, 12, 31), $begin);
    }

    public function testHowToKnowIfADateIsAfterBeforeEqualToAnOther()
    {
        $this->markTestIncomplete();
    }

    public function testHowToConvertADddTimeDateObjectIntoRegularDateTimeObject()
    {
        $this->markTestIncomplete();
    }

    public function testHowToKnowIfDateIsDuringWeekendOrWeekday()
    {
        $this->markTestIncomplete();
    }

    public function testHowToGetPreviousNextDate()
    {
        $this->markTestIncomplete();
    }

    public function testHowToAddRemoveADurationFromItCanReturnDateOrTimePoint()
    {
        $this->markTestIncomplete();
    }

    public function testHowToTransformADateIntoATimePoint()
    {
        $this->markTestIncomplete();
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
