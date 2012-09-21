<?php

namespace Rouffj\Time\Core;

/**
 * Represents a calendar
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar
{
    private $events;

    function __construct(EventProviderInterface $provider)
    {
        $this->provider = $provider;
        $this->events = $provider->getEvents();
    }
}
