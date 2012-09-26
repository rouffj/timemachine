<?php

namespace Rouffj\Time\Domain\Service;

use Rouffj\Time\Domain\Model\Core\TimeInterval;

interface CalendarLoaderInterface
{
    /**
     * @return \Rouffj\Time\Domain\Model\Calendar\CalendarInterface
     */
    function load();

    /**
     * @param TimeInterval|null $interval
     *
     * @return \Rouffj\Time\Domain\Model\Calendar\CalendarInterface
     */
    function loadInterval(TimeInterval $interval);
}
