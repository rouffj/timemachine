<?php

namespace TimeMachine\Calendar\Tests\HowTo;

use TimeMachine\Calendar\Model\Calendar;
use TimeMachine\Calendar\Model\CalendarInterface;
use TimeMachine\Calendar\Service\CalendarLoaderInterface;
use TimeMachine\Calendar\Service\CalendarPersisterInterface;
use TimeMachine\Calendar\Model\Event;
use TimeMachine\Time\Factory\TimeIntervalFactory;
use TimeMachine\Time\Model\TimeInterval;

class DoctorCalendarRepository implements CalendarLoaderInterface, CalendarPersisterInterface
{
    private $calendar;

    public function __construct()
    {
        $this->calendar = new Calendar('Doctor Smith\'s appointments', array(
            new Event(TimeIntervalFactory::create('2012-01-01 8:00', '2012-01-01 09:00')),
            new Event(TimeIntervalFactory::create('2012-01-05 8:00', '2012-01-05 10:15')),
            new Event(TimeIntervalFactory::create('2012-01-10 15:00', '2012-01-10 15:30')),
        ));
    }

    public function load()
    {
        return $this->calendar;
    }

    public function loadInterval(TimeInterval $interval)
    {
        return $this->calendar->between($interval);
    }

    public function persist(CalendarInterface $calendar)
    {
        $this->calendar = $calendar;
    }
}
