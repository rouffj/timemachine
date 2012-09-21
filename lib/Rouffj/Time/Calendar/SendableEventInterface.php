<?php

namespace Rouffj\Time\Calendar;

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
