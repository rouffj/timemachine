<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimeInterval;
use TimeMachine\Calendar\Model\EventInterface;

/**
 * Calendar interface.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface CalendarInterface extends EventsListInterface
{
    /**
     * @param TimeInterval $interval
     * @param string       $title
     *
     * @return Calendar
     */
    function extract(TimeInterval $interval, $title = '');

    /**
     * @param EventInterface $newEvent
     */
    function add(EventInterface $newEvent);

    /**
     * @param EventInterface $event
     */
    function remove(EventInterface $event);

    /**
     * @param string $title
     */
    function setTitle($title);

    /**
     * @return string
     */
    function getTitle();
}
