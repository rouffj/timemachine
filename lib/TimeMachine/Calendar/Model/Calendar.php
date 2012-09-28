<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Time\Model\TimeInterval;
use TimeMachine\Time\Factory\TimePointFactory;

use TimeMachine\Calendar\Service\EventProviderInterface;
use TimeMachine\Calendar\Model\EventInterface;
use TimeMachine\Calendar\Model\Strategy\BaseStrategy;
use TimeMachine\Calendar\Model\Strategy\StrategyInterface;

/**
 * Represents a calendar
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar implements CalendarInterface
{
    /**
     * @var EventInterface[]
     */
    private $events;

    /**
     * @var StrategyInterface
     */
    private $strategy;

    /**
     * @var string
     */
    private $title;

    /**
     * @var TimePoint
     */
    private $cursor;

    /**
     * @param string                 $title
     * @param array                  $events
     * @param StrategyInterface|null $strategy
     */
    public function __construct($title, array $events, StrategyInterface $strategy = null)
    {
        $this->strategy = (null === $strategy) ? new BaseStrategy() : $strategy;
        $this->title    = $title;
        $this->events   = array();

        foreach ($events as $event) {
            $this->add($event);
        }
        $this->cursor = (0 === count($this->events)) ? TimePointFactory::now() : $this->events[0]->getInterval()->getBegin();
    }

    /**
     * {@inheritdoc}
     */
    public function between(TimeInterval $interval, $title = '')
    {
        $selectedEvents = $this->getEvents($interval->getBegin(), $interval->getEnd());
        $narrowerCalendar = new self($title, $selectedEvents, $this->strategy);

        return $narrowerCalendar;
    }

    /**
     * {@inheritdoc}
     */
    public function add(EventInterface $newEvent)
    {
        $this->events = $this->strategy->add($newEvent, $this->events);
        $this->checkCursor();
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EventInterface $event)
    {
        $this->events = $this->strategy->remove($event, $this->events);
        $this->checkCursor();
    }

    /**
     * {@inheritdoc}
     */
    public function update(EventInterface $originalEvent, EventInterface $updatedEvent)
    {
        $this->events = $this->strategy->update($originalEvent, $updatedEvent, $this->events);
        $this->checkCursor();
    }

    /**
     * {@inheritdoc}
     */
    public function setCursor(TimePoint $cursor)
    {
        $this->cursor = $cursor;
    }

    /**
     * {@inheritdoc}
     */
    public function getCursor()
    {
        return $this->cursor;
    }

    /**
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param StrategyInterface $strategy
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @return StrategyInterface
     */
    public function getStrategy()
    {
        return $this->strategy;
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
     * @param TimePoint      $begin
     * @param null|TimePoint $end
     *
     * @return array
     */
    private function getEvents(TimePoint $begin, TimePoint $end = null)
    {
        $events = $this->events;

        $offset = 0;
        foreach ($events as $event) {
            if ($event->getInterval()->getEnd()->after($begin)) {
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
            if ($end->after($event->getInterval()->getBegin())) {
                break;
            } else {
                $length --;
            }
        }

        return array_slice($events, 0, $length);
    }

    private function checkCursor()
    {
        // @todo: implement this :)
    }
}
