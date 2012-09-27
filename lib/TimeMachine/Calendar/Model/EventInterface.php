<?php

namespace Rouffj\Time\Domain\Model\Event;

interface EventInterface
{
    /**
     * @return \TimeMachine\Time\Model\TimeInterval
     */
    function getInterval();

    /**
     * @param EventInterface $event
     *
     * @return bool
     */
    function equals(EventInterface $event);
}
