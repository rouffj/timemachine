<?php

namespace Rouffj\Examples\Time;

use Rouffj\Time\Domain\Service\EventProviderInterface;
use Rouffj\Time\Domain\Service\EventPersisterInterface;
use Rouffj\Time\Domain\Model\Event\Event;
use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Factory\TimeIntervalFactory;

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

    public function removeEvent(EventInterface $event)
    {
    }

    public function getName()
    {
        return 'Doctor Smith\'s appointments';
    }
}
