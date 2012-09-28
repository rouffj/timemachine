<?php

namespace TimeMachine\Calendar\Service;

use TimeMachine\Time\Model\TimeInterval;

interface CalendarLoaderInterface
{
    /**
     * Loads a calendar with all its events.
     *
     * @return \TimeMachine\Calendar\Model\CalendarInterface
     */
    function load();

    /**
     * Loads a calendar with a range of events.
     *
     * @param TimeInterval|null $interval
     *
     * @return \TimeMachine\Calendar\Model\CalendarInterface
     */
    function loadInterval(TimeInterval $interval);
}
