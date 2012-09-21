<?php

/**
 * Simple object which handle Event collection.
 *
 * TODO:
 * - Events in calendar should be always ordered (create OrderedValidator).
 * - Calendar should implements array access to iterate through all events
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar
{
    /**
     * examples: "Lyon prayer times 2012", "2012 france vacation"
     */
    private $name;

    private $description;

    private $events;

    public function __construct(array $events, $name = null, $description = null)
    {
        $this->events = new ArrayCollection($events);
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @param CalendarDateInterval Interval should be narrower than current calendar. Throw InvalidArgumentException otherwise
     *
     * @return Calendar A narrower Calendar
     */
    public function between(CalendarDateInterval $interval)
    {
        $eventsInGivenInterval = array();

        foreach ($this->events as $event) {
            if ($interval->contains($event->getTimeInterval())) {
                $eventsInGivenInterval[] = $event;
            }
        }

        $narrowerCalendar = new self($eventsInGivenInterval);

        return $narrowerCalendar;
    }

    /**
     * get the event
     *
     */
    public function get($eventId)
    {
    }

    /**
     * Remove an event from calendar
     *
     * @param int $eventId the id of the event to remove
     *
     * @return Event|null The removed element or null, if not found.
     */
    public function remove($eventId)
    {
        // code...
    }
}
