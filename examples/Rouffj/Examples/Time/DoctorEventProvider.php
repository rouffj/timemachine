<?php

namespace Rouffj\Examples\Time;
use Rouffj\Time\Calendar\EventProviderInterface;
use Rouffj\Time\Calendar\Event;
use Rouffj\Time\Factory\TimeIntervalFactory;
use Rouffj\Time\Factory\DateIntervalFactory;

class DoctorEventProvider implements EventProviderInterface
{
    public function getEvents()
    {
        return array(
            new Event(TimeIntervalFactory::create('2012-01-01 8:00', '2012-01-01 09:00')),
            new Event(TimeIntervalFactory::create('2012-01-05 8:00', '2012-01-05 10:15')),
            new Event(TimeIntervalFactory::create('2012-01-10 15:00', '2012-01-10 15:30')),
        );
    }

    public function getName()
    {
        return 'Doctor Smith\'s appointments';
    }
}
