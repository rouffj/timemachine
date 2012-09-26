<?php

namespace Rouffj\Time\Domain\Service;

use Rouffj\Time\Domain\Model\Event\EventInterface;

interface EventPersisterInterface
{
    /**
     * @param EventInterface $event
     */
    function add(EventInterface $event);

    /**
     * @param EventInterface $event
     */
    function update(EventInterface $event);

    /**
     * @param EventInterface $event
     */
    function remove(EventInterface $event);
}
