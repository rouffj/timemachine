<?php

namespace Rouffj\Time\Calendar;

interface EventPersisterInterface
{
    /**
     * @return array
     */
    function addEvent(EventInterface $event);
}
