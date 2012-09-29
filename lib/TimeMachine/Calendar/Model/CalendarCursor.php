<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimePoint;

/**
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class CursorInterface extends EventsList implements CalendarCursorInterface
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function getPoint()
    {
        return $this->point;
    }
}
