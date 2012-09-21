<?php

namespace Rouffj\Examples\Time;

use Rouffj\Time\Calendar\EventPersisterInterface;
use Rouffj\Time\Calendar\EventInterface;

class GoogleCalendarPersister implements EventPersisterInterface
{
    public function addEvent(EventInterface $event)
    {
        return true;
    }
}
