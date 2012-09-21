<?php

namespace Rouffj\Time\Calendar;

use Rouffj\Time\Core\TimePoint;
use Rouffj\Time\Core\TimeInterval;
use Rouffj\Time\Factory\TimePointFactory;

/**
 * Represents a calendar
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar implements \IteratorAggregate, \Countable
{
    /**
     * @var EventPersisterInterface
     */
    private $persister;

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
    public function __construct(EventProviderInterface $provider, EventPersisterInterface $persister = null)
    {
        $this->provider = $provider;
        $this->persister = $persister;
        $events = $provider->getEvents();
        $this->cursor = 0 === count($events) ? TimePointFactory::now() : $events[0]->getInterval()->getBegin();
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getEvents($this->cursor));
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->getEvents($this->cursor));
    }

    /**
     * @param TimeInterval $interval
     * @param string|null  $name
     *
     * @return Calendar
     */
    public function between(TimeInterval $interval, $name = null)
    {
        return new self(new EventProvider(
            $name ?: $this->getName(),
            $this->getEvents($interval->getBegin(), $interval->getEnd())
        ));
    }

    public function add(EventInterface $event)
    {
        $this->persister->addEvent($event);
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
    private function getEvents(TimePoint $begin, TimePoint $end = null)
    {
        $events = $this->provider->getEvents();

        $offset = 0;
        foreach ($events as $event) {
            if ($event->getInterval()->getEnd()->greater($begin)) {
                break;
            } else {
                $offset ++;
            }
        }
        $events = array_slice($events, $offset);

        if (null === $end) {
            return $events;
        }

        $length = count($events);
        foreach (array_reverse($events) as $event) {
            if ($end->greater($event->getInterval()->getBegin())) {
                break;
            } else {
                $length --;
            }
        }

        return array_slice($events, 0, $length);
    }
}
