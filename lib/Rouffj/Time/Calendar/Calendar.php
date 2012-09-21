<?php

namespace Rouffj\Time\Calendar;

use Rouffj\Time\Core\TimePoint;

/**
 * Represents a calendar
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar implements \IteratorAggregate, \Countable
{
    /**
     * @var Event[]
     */
    private $events;

    /**
     * @var TimePoint
     */
    private $cursor;

    /**
     * @param EventProviderInterface $provider
     *
     * @throws \LogicException
     */
    public function __construct(EventProviderInterface $provider)
    {
        $this->events = $provider->getEvents();

        if (0 === count($this->events)) {
            throw new \LogicException('Cannot initialize empty calendar.');
        }

        $this->cursor = $this->events[0]->getInterval()->getBegin();
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getEvents());
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->getEvents());
    }

    /**
     * @param TimePoint $cursor
     */
    public function setCursor(TimePoint $cursor)
    {
        $this->cursor = $cursor;
    }

    /**
     * @return TimePoint
     */
    public function getCursor()
    {
        return $this->cursor;
    }

    /**
     * @return array
     */
    protected function getEvents()
    {
        $offset = 0;
        foreach ($this->events as $event) {
            if ($event->getInterval()->getEnd()->greater($this->cursor)) {
                break;
            } else {
                $offset ++;
            }
        }

        return array_slice($this->events, $offset);
    }
}
