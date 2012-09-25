<?php

namespace Rouffj\Time\Domain\Service;

use Rouffj\Time\Domain\Model\Event\EventInterface;

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
