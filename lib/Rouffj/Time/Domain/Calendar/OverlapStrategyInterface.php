<?php

namespace Rouffj\Time\Calendar\Overlap;

use Rouffj\Time\Calendar\EventInterface;

interface OverlapStrategyInterface
{
    /**
     * @return EventInterface[] events with new event introduced if follow overlap strategy
     */
    function add(EventInterface $newEvent, array $events);
}
