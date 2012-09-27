<?php

namespace TimeMachine\Calendar\Service;

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
