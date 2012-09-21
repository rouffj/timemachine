<?php

namespace Rouffj\Examples\Time;
use Rouffj\Time\Calendar\EventProviderInterface;
use Rouffj\Time\Calendar\Event;
use Rouffj\Time\Factory\TimeIntervalFactory;
use Rouffj\Time\Factory\DateIntervalFactory;

use Rouffj\Time\Calendar\EventPersisterInterface;
use Rouffj\Time\Calendar\EventInterface;

class DoctorEventRepository implements EventProviderInterface, EventPersisterInterface
{
    private $events = array();

    public function __construct()
    {
        $this->events = array(
            new Event(TimeIntervalFactory::create('2012-01-01 8:00', '2012-01-01 09:00')),
            new Event(TimeIntervalFactory::create('2012-01-05 8:00', '2012-01-05 10:15')),
            new Event(TimeIntervalFactory::create('2012-01-10 15:00', '2012-01-10 15:30')),
        );
    }

    public function getEvents()
    {
        return $this->events;
    }

    public function addEvent(EventInterface $event)
    {
        $this->events[] = $event;
    }

    public function getName()
    {
        return 'Doctor Smith\'s appointments';
    }
}
