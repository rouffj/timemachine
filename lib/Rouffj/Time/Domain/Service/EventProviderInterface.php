<?php

namespace Rouffj\Time\Domain\Service;

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
