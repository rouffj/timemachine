<?php

namespace Rouffj\Time\Calendar;

interface EventInterface
{
    /**
     * @return \Rouffj\Time\Core\TimeInterval
     */
    function getInterval();
}
