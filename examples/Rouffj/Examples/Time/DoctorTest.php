<?php

namespace Rouffj\Examples\Time;

use Rouffj\Tests\TestCase;
use Rouffj\Time\Core\TimePoint;
use Rouffj\Time\Calendar\Calendar;
use Rouffj\Time\Calendar\Event;
use Rouffj\Time\Factory\TimeIntervalFactory;
use Rouffj\Time\Factory\DateIntervalFactory;

class DoctorTest extends TestCase
{
    public function testHowToRetrieveAllMyAppointments()
    {
        $calendar = new Calendar(new DoctorEventRepository());

        $this->assertSame('Doctor Smith\'s appointments', $calendar->getTitle());
        $this->assertCount(3, $calendar);
    }

    public function testHowToRetrieveMyAppointmentsForToday()
    {
        $calendar = new Calendar(new DoctorEventRepository());
        $today = DateIntervalFactory::create('2012-01-01', '2012-01-01');
        $this->assertCount(1, $calendar->between(TimeIntervalFactory::fromDateInterval($today)));
    }

    public function testHowToRetrieveAppointmentsAfterADate()
    {
        $calendar = new Calendar(new DoctorEventRepository());
        $today = new TimePoint(2012, 1, 1, 10, 0);
        $calendar->setCursor($today);
        $this->assertCount(2, $calendar);
    }

    public function testHowToRetrieveMyAppointmentsForCurrentWeek()
    {
        $calendar = new Calendar(new DoctorEventRepository());
        $week = DateIntervalFactory::create('2012-01-01', '2012-01-07');
        $this->assertCount(2, $calendar->between(TimeIntervalFactory::fromDateInterval($week)));
    }

    public function testHowToAddNewAppointment()
    {
        $repo = new DoctorEventRepository();
        $calendar = new Calendar($repo);
        $event = new Event(TimeIntervalFactory::create('2012-01-01 17:00', '2012-01-01 18:00'));
        $calendar->add($event);
        $this->assertCount(4, $calendar);
    }
}

