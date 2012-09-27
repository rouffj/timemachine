<?php

namespace Rouffj\Time\Domain\Service;

use TimeMachine\Calendar\Model\EventInterface;

interface EventPersisterInterface
{
    /**
     * @param EventInterface $event
     */
    function addEvent(EventInterface $event);

    /**
     * @param EventInterface $event
     */
    function removeEvent(EventInterface $event);
}
