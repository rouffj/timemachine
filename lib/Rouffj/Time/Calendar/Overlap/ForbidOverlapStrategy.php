<?php

namespace Rouffj\Time\Calendar\Overlap;

use Rouffj\Time\Calendar\EventInterface;

/**
 * Overlap strategy which permits introducing a new event event if existing event is present
 * in the same interval of time.
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class ForbidOverlapStrategy implements OverlapStrategyInterface
{
    public function add(EventInterface $newEvent, array $events)
    {
        foreach ($events as $pos => $event) {
            if ($newEvent->getInterval()->isBefore($event->getInterval())) {
                $offset = (0 === $pos) ? 0 : $pos - 1;
                array_splice($events, $offset, 0, array($newEvent));

                return $events;
            } else if ($newEvent->getInterval()->isDuring($event->getInterval())) {
                throw new OverlapException('An overlap is detected with the following event: ');
            }
        }
    }
}
