<?php

namespace Rouffj\Examples\Time;

use Rouffj\Tests\TestCase;
use Rouffj\Time\Domain\Model\Core\TimePoint;
use Rouffj\Time\Domain\Model\Calendar\Calendar;
use Rouffj\Time\Domain\Model\Calendar\BaseStrategy;
use Rouffj\Time\Domain\Model\Event\Event;
use Rouffj\Time\Domain\Factory\TimeIntervalFactory;
use Rouffj\Time\Domain\Factory\DateIntervalFactory;

class DoctorTest extends TestCase
{
    private $calendar;

    public function setup()
    {
        $repository = new DoctorCalendarRepository();
        $this->calendar = $repository->load();
    }

    public function testHowToRetrieveAllMyAppointments()
    {
        $this->assertSame('Doctor Smith\'s appointments', $this->calendar->getTitle());
        $this->assertCount(3, $this->calendar);
    }

    public function testHowToRetrieveMyAppointmentsForToday()
    {
        $today = DateIntervalFactory::create('2012-01-01', '2012-01-01');
        $this->assertCount(1, $this->calendar->between(TimeIntervalFactory::fromDateInterval($today)));
    }

    public function testHowToRetrieveAppointmentsAfterADate()
    {
        $today = new TimePoint(2012, 1, 1, 10, 0);
        $this->calendar->setCursor($today);
        $this->assertSame(2, $this->calendar->countRemaining());
    }

    public function testHowToRetrieveMyAppointmentsForCurrentWeek()
    {
        $week = DateIntervalFactory::create('2012-01-01', '2012-01-07');
        $this->assertCount(2, $this->calendar->between(TimeIntervalFactory::fromDateInterval($week)));
    }

    public function testHowToAddNewAppointment()
    {
        $event = new Event(TimeIntervalFactory::create('2012-01-01 17:00', '2012-01-01 18:00'));
        $this->calendar->add($event);
        $this->assertCount(4, $this->calendar);
    }
}

