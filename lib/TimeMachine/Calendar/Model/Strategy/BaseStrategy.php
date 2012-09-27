<?php

namespace TimeMachine\Calendar\Model\Strategy;

use TimeMachine\Calendar\Model\EventInterface;

/**
 * Base strategy which permit everything.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class BaseStrategy implements StrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function add(EventInterface $newEvent, array $events)
    {
        $index = 0;
        foreach ($events as $event) {
            if ($newEvent->getInterval()->isBefore($event->getInterval())) {
                array_splice($events, $index, 0, array($newEvent));

                return $events;
            }
            $index ++;
        }
        $events[] = $newEvent;

        return $events;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EventInterface $removedEvent, array $events)
    {
        $index = 0;
        foreach ($events as $event) {
            if ($removedEvent->equals($event)) {
                array_splice($events, $index, 1);
            } else {
                $index ++;
            }
        }

        return $events;
    }
}
