<?php

namespace Rouffj\Time\Domain\Model\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;

interface StrategyInterface
{
    /**
     * Applies event add to collection.
     *
     * @param EventInterface   $newEvent Event to add to collection
     * @param EventInterface[] $events   Given collection
     *
     * @return EventInterface[] Resulting collection
     *
     * @throws \Rouffj\Time\Domain\Exception\CalendarEventException
     */
    function add(EventInterface $newEvent, array $events);

    /**
     * Applies event removal from collection.
     *
     * @param EventInterface   $removedEvent Event to add to collection
     * @param EventInterface[] $events       Given collection
     *
     * @return EventInterface[] Resulting collection
     *
     * @throws \Rouffj\Time\Domain\Exception\CalendarEventException
     */
    function remove(EventInterface $removedEvent, array $events);

    /**
     * Applies updated event to original.
     *
     * @param EventInterface   $originalEvent Original event
     * @param EventInterface   $updatedEvent  Updated event
     * @param EventInterface[] $events        Given collection
     *
     * @return EventInterface[] Resulting collection
     *
     * @throws \Rouffj\Time\Domain\Exception\CalendarEventException
     */
    function update(EventInterface $originalEvent, EventInterface $updatedEvent, array $events);
}
