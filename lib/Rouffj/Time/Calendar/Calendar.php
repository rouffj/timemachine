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
     * @var EventProviderInterface
     */
    private $provider;

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
        if (0 === count($provider->getEvents())) {
            throw new \LogicException('Cannot initialize empty calendar.');
        }

        $this->provider = $provider;
        $events = $provider->getEvents();
        $this->cursor = $events[0]->getInterval()->getBegin();
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

    public function between()
    {

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
     * @return string
     */
    public function getName()
    {
        return $this->provider->getName();
    }

    /**
     * @return array
     */
    protected function getEvents()
    {
        $offset = 0;
        $events = $this->provider->getEvents();
        foreach ($events as $event) {
            if ($event->getInterval()->getEnd()->greater($this->cursor)) {
                break;
            } else {
                $offset ++;
            }
        }

        return array_slice($events, $offset);
    }
}
