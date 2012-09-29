<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimePoint;

/**
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class CalendarCursor extends EventsList
{
    /**
     * @var CalendarInterface
     */
    private $calendar;

    /**
     * @var TimePoint
     */
    private $point;

    /**
     * @param CalendarInterface $calendar
     * @param TimePoint         $point
     */
    public function __construct(CalendarInterface $calendar, TimePoint $point)
    {
        $this->calendar = $calendar;
        $this->setPoint($point);
    }

    /**
     * @return CalendarInterface
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * @param TimePoint $point
     */
    public function setPoint(TimePoint $point)
    {
        $this->point = $point;

        $this->events = EventsExtractor::create($this->calendar->getEvents())
            ->after($point)
            ->getEvents();
    }

    /**
     * @return TimePoint
     */
    public function getPoint()
    {
        return $this->point;
    }
}
