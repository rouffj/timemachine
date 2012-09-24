<?php

namespace Rouffj\Time\Domain\Model\Event;

interface EventInterface
{
    /**
     * @return \Rouffj\Time\Domain\Model\Core\TimeInterval
     */
    function getInterval();
}
