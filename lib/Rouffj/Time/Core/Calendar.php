<?php

namespace Rouffj\Time\Core;

/**
 * Represents a calendar
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar
{
    private $current;
    private $events;
    private $eventIndex = 0;

    function __construct(DateProviderInterface $provider)
    {
        $this->provider = $provider;
        $this->events = $provider->getDates();
        $this->setDate(1, 1);
    }

    public function setDate($month, $day)
    {
        $this->current = new CalendarDate($this->provider->getYear(), $month, $day);

        while (!$this->events[$this->eventIndex]->greater($this->current) && !$this->events[$this->eventIndex]->equals($this->current)) {
            $this->next();
        }
    }

    public function next()
    {
        $current = $this->eventIndex;
        if ($this->eventIndex + 1 < count($this->events) ) {
        var_dump($this->eventIndex);
            $this->eventIndex = $this->eventIndex + 1;
        }
        return isset($this->events[$current]) ? $this->events[$current] : null;
    }

    public function getDate()
    {
        return $this->current;
    }
}
