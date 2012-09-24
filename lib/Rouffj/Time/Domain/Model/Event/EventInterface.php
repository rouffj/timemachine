<?php

namespace Rouffj\Time\Calendar;

interface EventInterface
{
    /**
     * @return \Rouffj\Time\Domain\Model\TimeInterval
     */
    function getInterval();
}
