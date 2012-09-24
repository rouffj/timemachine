<?php

namespace Rouffj\Time\Domain\Service;

use Rouffj\Time\Domain\Model\Event\EventInterface;

interface EventPersisterInterface
{
    /**
     * @return array
     */
    function addEvent(EventInterface $event);
}
