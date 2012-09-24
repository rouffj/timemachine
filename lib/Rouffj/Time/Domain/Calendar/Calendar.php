<?php

namespace Rouffj\Time\Domain\Model;

use Rouffj\Time\Domain\Model\Core\TimePoint;
use Rouffj\Time\Domain\Model\Core\TimeInterval;
use Rouffj\Time\Factory\TimePointFactory;
use Rouffj\Time\Calendar\Overlap\AllowOverlapStrategy;
use Rouffj\Time\Calendar\Overlap\ForbidOverlapStrategy;


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
     * @var bool
     */
    private $overlapStrategy;

    /**
     * @var string
     */
    private $title;

    /**
     * @var TimePoint
     */
    private $cursor;

    /**
     * @param EventProviderInterface $provider
     *
     * @throws \LogicException
     */
    public function __construct(EventProviderInterface $eventProvider, array $options = array())
    {
        $options = array_merge(array(
            'overlap' => true
        ), $options);

        $overlap = (bool)$options['overlap'];
        $this->overlapStrategy = (true === $overlap) ? new AllowOverlapStrategy() : new ForbidOverlapStrategy();

        $this->events = $eventProvider->getEvents();
        $this->title = $eventProvider->getName();
        $this->cursor = 0 === count($this->events) ? TimePointFactory::now() : $this->events[0]->getInterval()->getBegin();
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
        return count($this->events);
    }

    /**
     * {@inheritdoc}
     */
    public function countRemaining()
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
        $narrowerCalendar = new self(new EventProvider(
            $name ?: $this->title,
            $this->getEvents($interval->getBegin(), $interval->getEnd())
        ));

        return $narrowerCalendar;
    }

    public function add(EventInterface $newEvent)
    {
        $this->events = $this->overlapStrategy->add($newEvent, $this->events);
        //$this->setCursor($this->events[0]->getInterval()->getBegin());
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array
     */
    private function getEvents(TimePoint $begin, TimePoint $end = null)
    {
        $events = $this->events;

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
