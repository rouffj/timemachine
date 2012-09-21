<?php

namespace Rouffj\Time\Calendar;

interface EventProviderInterface
{
    /**
     * @return array
     */
    function getEvents();

    /**
     * @return string
     */
    function getName();
}
