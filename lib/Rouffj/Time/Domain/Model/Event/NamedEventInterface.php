<?php

namespace Rouffj\Time\Calendar;

interface NamedEventInterface extends EventInterface
{
    /**
     * @return string
     */
    function getTitle();

    /**
     * @return string
     */
    function getDescription();
}
