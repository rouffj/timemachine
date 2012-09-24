<?php

namespace Rouffj\Time\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;

interface EventPersisterInterface
{
    /**
     * @return array
     */
    function addEvent(EventInterface $event);
}
