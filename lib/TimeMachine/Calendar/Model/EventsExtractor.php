<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimePoint;

/**
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class EventsExtractor
{
    /**
     * @var EventInterface[]
     */
    private $events;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->events = array();
    }

    /**
     * @param array $events
     *
     * @return EventsExtractor
     */
    public static function create(array $events)
    {
        $extractor = new self();
        foreach ($events as $event) {
            $extractor->add($event);
        }
        $extractor->order();

        return $extractor;
    }

    /**
     * @param EventInterface $event
     */
    public function add(EventInterface $event)
    {
        $this->events[] = $event;
    }

    public function order()
    {
        usort($this->events, array($this, 'order'));
    }

    /**
     * @param EventInterface $a
     * @param EventInterface $b
     *
     * @return int
     */
    public function compare(EventInterface $a, EventInterface $b)
    {
        switch (true) {
            case $a->getInterval()->getBegin()->after($b): return -1;
            case $a->getInterval()->getBegin()->equals($b): return 0;
            default: return 1;
        }
    }

    /**
     * @param TimePoint $point
     *
     * @return EventsExtractor
     */
    public function before(TimePoint $point)
    {
        while (count($this->events) > 0) {
            $end = $this->events[0]->getInterval()->getEnd();
            if ($end->after($point) || $end->equals($point)) {
                return $this;
            }
            array_shift($this->events);
        }

        return $this;
    }

    /**
     * @param TimePoint $point
     *
     * @return EventsExtractor
     */
    public function after(TimePoint $point)
    {
        while (count($this->events) > 0) {
            $begin = end($this->events)->getInterval()->getBegin();
            if ($begin->before($point) || $begin->equals($point)) {
                return $this;
            }
            array_pop($this->events);
        }

        return $this;
    }

    /**
     * @return EventInterface[]
     */
    public function getEvents()
    {
        return $this->events;
    }
}
