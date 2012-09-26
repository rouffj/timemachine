<?php

namespace Rouffj\Time\Domain\Model\Calendar;

use Rouffj\Time\Domain\Model\Core\TimePoint;
use Rouffj\Time\Domain\Model\Core\TimeInterval;
use Rouffj\Time\Domain\Model\Event\EventInterface;

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
     * @param EventInterface $originalEvent
     * @param EventInterface $updatedEvent
     */
    public function update(EventInterface $originalEvent, EventInterface $updatedEvent);

    /**
     * @param TimePoint $cursor
     */
    public function setCursor(TimePoint $cursor);

    /**
     * @return TimePoint
     */
    public function getCursor();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * {@inheritdoc}
     */
    public function countRemaining();
}
