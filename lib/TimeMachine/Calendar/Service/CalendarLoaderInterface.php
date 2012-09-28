<?php

namespace TimeMachine\Calendar\Service;

use TimeMachine\Time\Model\TimeInterval;

interface CalendarLoaderInterface
{
    /**
     * @return \TimeMachine\Calendar\Model\CalendarInterface
     */
    function load();

    /**
     * @param TimeInterval|null $interval
     *
     * @return \TimeMachine\Calendar\Model\CalendarInterface
     */
    function loadInterval(TimeInterval $interval);
}
