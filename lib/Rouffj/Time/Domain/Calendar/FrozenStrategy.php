<?php

namespace Rouffj\Time\Domain\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Exception\FrozenCalendarException;

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
        throw new FrozenCalendarException();
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EventInterface $newEvent, array $events)
    {
        throw new FrozenCalendarException();
    }
}
