<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimeInterval;

/**
 * Immutable events list.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class EventsList implements EventsListInterface
{
    /**
     * @var array
     */
    protected $events;

    /**
     * @param array $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->events[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->events[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        throw new \LogicException('This event list is immutable.');
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        throw new \LogicException('This event list is immutable.');
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->events);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirst()
    {
        return reset($this->events);
    }

    /**
     * {@inheritdoc}
     */
    public function getLast()
    {
        return end($this->events);
    }
}
