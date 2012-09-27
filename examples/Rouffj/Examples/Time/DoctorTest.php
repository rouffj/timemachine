<?php

namespace Rouffj\Examples\Time;

use Rouffj\Tests\TestCase;
use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Calendar\Model\Calendar;
use TimeMachine\Calendar\Model\BaseStrategy;
use TimeMachine\Calendar\Model\Event;
use TimeMachine\Time\Factory\TimeIntervalFactory;
use TimeMachine\Time\Factory\DateIntervalFactory;

class DoctorTest extends TestCase
{
    public function setup()
    {
        $this->repository = new DoctorEventRepository();
        $this->calendar = new Calendar($this->repository->getName(), $this->repository->getEvents());
    }

    public function testHowToRetrieveAllMyAppointments()
    {
        $calendar = $this->calendar;

        $this->assertSame('Doctor Smith\'s appointments', $calendar->getTitle());
        $this->assertCount(3, $calendar);
    }

    public function testHowToRetrieveMyAppointmentsForToday()
    {
        $calendar = $this->calendar;

        $today = DateIntervalFactory::create('2012-01-01', '2012-01-01');
        $this->assertCount(1, $calendar->between(TimeIntervalFactory::fromDateInterval($today)));
    }

    public function testHowToRetrieveAppointmentsAfterADate()
    {
        $calendar = $this->calendar;

        $today = new TimePoint(2012, 1, 1, 10, 0);
        $calendar->setCursor($today);
        $this->assertSame(2, $calendar->countRemaining());
    }

    public function testHowToRetrieveMyAppointmentsForCurrentWeek()
    {
        $calendar = $this->calendar;

        $week = DateIntervalFactory::create('2012-01-01', '2012-01-07');
        $this->assertCount(2, $calendar->between(TimeIntervalFactory::fromDateInterval($week)));
    }

    public function testHowToAddNewAppointment()
    {
        $calendar = $this->calendar;

        $event = new Event(TimeIntervalFactory::create('2012-01-01 17:00', '2012-01-01 18:00'));
        $calendar->add($event);
        $this->assertCount(4, $calendar);
    }
}

