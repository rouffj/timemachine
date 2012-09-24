<?php

namespace Rouffj\Time\Domain\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Exception\OverlapException;

/**
 * Overlap strategy which permits introducing a new event event if existing event is present
 * in the same interval of time.
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class NoOverlapStrategy extends BaseStrategy
{
    /**
     * {@inheritdoc}
     */
    public function add(EventInterface $newEvent, array $events)
    {
        foreach ($events as $event) {
            if ($newEvent->getInterval()->isDuring($event->getInterval())) {
                throw new OverlapException('An overlap is detected with the following event: ');
            }
        }

        return parent::add($newEvent, $events);
    }
}
