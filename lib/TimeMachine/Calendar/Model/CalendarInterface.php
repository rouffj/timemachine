<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Time\Model\TimeInterval;
use TimeMachine\Calendar\Model\EventInterface;
use Rouffj\Time\Domain\Factory\TimePointFactory;
use Rouffj\Time\Domain\Service\EventProviderInterface;

/**
 * Calendar interface
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface CalendarInterface extends \IteratorAggregate, \Countable
{
    /**
     * @param TimeInterval $interval
     * @param string       $title
     *
     * @return Calendar
     */
    public function between(TimeInterval $interval, $title = '');

    /**
     * @param EventInterface $newEvent
     */
    public function add(EventInterface $newEvent);

    /**
     * @param EventInterface $event
     */
    public function remove(EventInterface $event);

    /**
     * @param StrategyInterface $strategy
     */
    public function setStrategy(StrategyInterface $strategy);

    /**
     * @return StrategyInterface
     */
    public function getStrategy();

    /**
     * @param TimePoint $cursor
     */
    public function setCursor(TimePoint $cursor);

    /**
     * @return TimePoint
     */
    public function getCursor();

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * {@inheritdoc}
     */
    public function count();

    /**
     * {@inheritdoc}
     */
    public function countRemaining();
}
