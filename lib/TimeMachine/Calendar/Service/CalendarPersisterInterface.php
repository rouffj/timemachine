<?php

namespace TimeMachine\Calendar\Service;

use TimeMachine\Calendar\Model\CalendarInterface;
use TimeMachine\Calendar\Model\EventInterface;

interface CalendarPersisterInterface
{
    /**
     * Persists a calendar with all its events.
     *
     * @param CalendarInterface $calendar
     */
    function persist(CalendarInterface $calendar);
}
