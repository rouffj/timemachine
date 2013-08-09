<?php

namespace TimeMachine\Calendar\Model;

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
    function isEquals(EventInterface $event);
}
