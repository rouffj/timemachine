<?php

namespace Rouffj\Time\Calendar;

use Rouffj\Time\Core\TimeInterval;

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
