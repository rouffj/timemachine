<?php

namespace Rouffj\Time\Domain\Model\Event;

use Rouffj\Time\Domain\Model\Core\TimeInterval;

class Event implements EventInterface
{
    private $interval;

    public function __construct(TimeInterval $interval)
    {
        $this->interval = $interval;
    }

    public function getInterval()
    {
        return $this->interval;
    }

    public function equals(EventInterface $event)
    {
        return $this->interval->getBegin()->equals($event->getInterval()->getBegin())
            && $this->interval->getEnd()->equals($event->getInterval()->getEnd());
    }
}
