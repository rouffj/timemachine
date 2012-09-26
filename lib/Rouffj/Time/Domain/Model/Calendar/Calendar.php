<?php

namespace Rouffj\Time\Domain\Model\Calendar;

use Rouffj\Time\Domain\Model\Core\TimePoint;
use Rouffj\Time\Domain\Model\Core\TimeInterval;
use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Factory\TimePointFactory;
use Rouffj\Time\Domain\Service\EventProviderInterface;
use Rouffj\Time\Domain\Model\Calendar\BaseStrategy;

/**
 * Represents a calendar
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar implements CalendarInterface
{
    /**
     * @var Event[]
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
     * {@inheritdoc}
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

    private function checkCursor()
    {
        // @todo: implement this :)
    }
}
