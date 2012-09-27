<?php

namespace Rouffj\Time\Domain\Model\Event;

interface SendableEventInterface extends EventInterface
{
    /**
     * @return string
     */
    function getOrganizer();

    /**
     * @return array
     */
    function getGuests();
}
