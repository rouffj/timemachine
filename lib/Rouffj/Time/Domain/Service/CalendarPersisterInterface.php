<?php

namespace Rouffj\Time\Domain\Service;

use Rouffj\Time\Domain\Model\Calendar\CalendarInterface;
use Rouffj\Time\Domain\Model\Event\EventInterface;

interface CalendarPersisterInterface
{
    /**
     * @param CalendarInterface $calendar
     */
    function persist(CalendarInterface $calendar);
}
