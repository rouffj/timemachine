<?php

namespace TimeMachine\Calendar\Model\Strategy;

use TimeMachine\Calendar\Model\EventInterface;

interface StrategyInterface
{
    /**
     * Applies event add to collection.
     *
     * @param EventInterface   $newEvent Event to add to collection
     * @param EventInterface[] $events   Given collection
     *
     * @return EventInterface[] Resulting collection
     */
    function add(EventInterface $newEvent, array $events);

    /**
     * Applies event removal from collection.
     *
     * @param EventInterface   $removedEvent Event to add to collection
     * @param EventInterface[] $events       Given collection
     *
     * @return EventInterface[] Resulting collection
     */
    function remove(EventInterface $removedEvent, array $events);
}
