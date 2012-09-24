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

    public function __toString()
    {
        return 'From ' . $this->interval->getBegin() . ' To ' . $this->interval->getEnd();
    }
}
