<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Time\Model\TimeInterval;
use TimeMachine\Calendar\Model\EventInterface;
use TimeMachine\Time\Factory\TimePointFactory;
use TimeMachine\Calendar\Service\EventProviderInterface;

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
