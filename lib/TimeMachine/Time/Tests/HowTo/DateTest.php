<?php

namespace TimeMachine\Time\Tests\HowTo;

use TimeMachine\Time\Tests\TestCase;
use TimeMachine\Time\Model\Date;

class DateTest extends TestCase
{
    public function testHowToCreateADateOnly()
    {

    }

    public function testHowToComeBackAtBeginOfCurrentWeek()
    {
        $date = new Date(2013, 1, 4);
        $begin = $date->beginOfWeek();

        $this->assertEquals(new Date(2012, 12, 31), $begin);
    }

    public function testHowToKnowIfADateIsAfterBeforeEqualToAnOther()
    {

    }

    public function testHowToConvertADddTimeDateObjectIntoRegularDateTimeObject()
    {

    }

    public function testHowToKnowIfDateIsDuringWeekendOrWeekday()
    {

    }

    public function testHowToGetPreviousNextDate()
    {

    }

    public function testHowToAddRemoveADurationFromItCanReturnDateOrTimePoint()
    {

    }

    public function testHowToTransformADateIntoATimePoint()
    {

    }

    public function testHowToKnowThePositionInDaysWeeksMonthsYearsSinceAnOtherDate()
    {

    }

    public function testHowToKnowDiffBetweenItAndAnOtherDate()
    {

    }

    public function testHowToKnowDiffBetweenItAndATimePoint()
    {

    }
}
