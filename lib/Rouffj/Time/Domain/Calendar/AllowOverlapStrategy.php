<?php

namespace Rouffj\Time\Domain\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;

/**
 * Overlap strategy which permits introducing a new event event if existing event is present
 * in the same interval of time.
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class AllowOverlapStrategy implements OverlapStrategyInterface
{
    public function add(EventInterface $newEvent, array $events)
    {
        foreach ($events as $pos => $event) {
            if ($newEvent->getInterval()->isBefore($event->getInterval())) {
                $offset = (0 === $pos) ? 0 : $pos - 1;
                array_splice($events, $offset, 0, array($newEvent));

                return $events;
            }
        }
    }
}
