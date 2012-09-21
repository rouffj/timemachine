<?php

namespace Rouffj\Examples\Time;

use Rouffj\Tests\TestCase;
use Rouffj\Time\Calendar\Calendar;
use Rouffj\Time\Calendar\Event;
use Rouffj\Time\Factory\TimeIntervalFactory;
use Rouffj\Time\Factory\DateIntervalFactory;

class DoctorTest extends TestCase
{
    public function testHowToRetrieveAllMyAppointments()
    {
        $calendar = new Calendar(new DoctorEventProvider());

        $this->assertSame('Doctor Smith\'s appointments', $calendar->getName());
        $this->assertCount(3, $calendar);
    }

    public function testHowToRetrieveMyAppointmentsForToday()
    {
        $calendar = new Calendar(new DoctorEventProvider());
        $today = DateIntervalFactory::create('2012-01-01', '2012-01-01');
        $this->assertCount(1, $calendar->between(TimeIntervalFactory::fromDateInterval($today)));
    }

    public function testHowToRetrieveMyAppointmentsForCurrentWeek()
    {
        $calendar = new Calendar(new DoctorEventProvider());
        $today = DateIntervalFactory::create('2012-01-01', '2012-01-07');
        $this->assertCount(2, $calendar->between(TimeIntervalFactory::fromDateInterval($today)));
    }
}

