<?php

namespace Rouffj\Time\Domain\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;

interface StrategyInterface
{
    /**
     * Applies event add to collection.
     *
     * @param EventInterface   $newEvent   Event to add to collection
     * @param EventInterface[] $collection Given collection
     *
     * @return EventInterface[] Resulting collection
     */
    function add(EventInterface $newEvent, array $collection);

    /**
     * Applies event removal from collection.
     *
     * @param EventInterface   $newEvent   Event to add to collection
     * @param EventInterface[] $collection Given collection
     *
     * @return EventInterface[] Resulting collection
     */
    function remove(EventInterface $newEvent, array $collection);
}
