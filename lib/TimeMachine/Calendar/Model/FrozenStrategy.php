<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Calendar\Model\EventInterface;
use Rouffj\Time\Domain\Exception\CalendarEventException;

/**
 * Strategy which don't permit anything.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class FrozenStrategy implements StrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function add(EventInterface $newEvent, array $events)
    {
        throw CalendarEventException::addWhileFrozen($newEvent);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EventInterface $removedEvent, array $events)
    {
        throw CalendarEventException::removeWhileFrozen($removedEvent);
    }
}
