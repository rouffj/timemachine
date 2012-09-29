<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Time\Model\TimeInterval;
use TimeMachine\Time\Factory\TimePointFactory;
use TimeMachine\Time\Model\Duration;

use TimeMachine\Calendar\Service\EventProviderInterface;
use TimeMachine\Calendar\Model\EventInterface;
use TimeMachine\Calendar\Model\Strategy\BaseStrategy;
use TimeMachine\Calendar\Model\Strategy\StrategyInterface;

/**
 * Represents a calendar
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class Calendar extends EventsList implements CalendarInterface
{
    /**
     * @var StrategyInterface
     */
    private $strategy;

    /**
     * @var string
     */
    private $title;

    /**
     * @param string            $title
     * @param array             $events
     * @param StrategyInterface $strategy
     */
    public function __construct($title, array $events = array(), StrategyInterface $strategy = null)
    {
        $this->strategy = (null === $strategy) ? new BaseStrategy() : $strategy;
        $this->title    = $title;
        $this->events   = array();

        foreach ($events as $event) {
            $this->add($event);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function extract(TimeInterval $interval, $title = '')
    {
        $events = EventsExtractor::create($this->events)
            ->after($interval->getBegin())
            ->before($interval->getEnd())
            ->getEvents();

        return new static($title, $events, $this->strategy);
    }

    /**
     * {@inheritdoc}
     */
    public function add(EventInterface $newEvent)
    {
        $this->events = $this->strategy->add($newEvent, $this->events);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EventInterface $event)
    {
        $this->events = $this->strategy->remove($event, $this->events);
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
}
