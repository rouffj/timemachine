<?php

namespace Rouffj\Time\Domain\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;

interface OverlapStrategyInterface
{
    /**
     * @return EventInterface[] events with new event introduced if follow overlap strategy
     */
    function add(EventInterface $newEvent, array $events);
}
