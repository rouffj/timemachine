<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimeUnitInterval;
use TimeMachine\Time\Factory\TimeUnitIntervalFactory;
use TimeMachine\Time\Factory\TimeUnitFactory;
use TimeMachine\Time\Model\TimeUnit;

/**
 * Represents a subset of calendar in a unit interval.
 *
 * Examples:
 * - Get calendar for year 2012:
 *   $subCalendar = new CalendarUnit($calendar, new TimeUnitInterval(TimeUnitFactory::year(), 2012));
 * - Get week calendar around 2012-09-29
 *   $subCalendar = new CalendarUnit($calendar, TimeUnitIntervalFactory::containing(TimePointFactory::fromString('2012-09-29'), TimeUnitFactory::week()));
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class CalendarUnit extends EventsList
{
    /**
     * @var CalendarInterface
     */
    private $calendar;

    /**
     * @var TimeUnitInterval
     */
    private $unitInterval;

    /**
     * Builds an array of CalendarUnit for given calendar and time unit.
     *
     * @param CalendarInterface $calendar Parent calendar
     * @param null|TimeUnit     $unit     Time unit, year by default
     *
     * @return CalendarUnit[]
     */
    public static function collection(CalendarInterface $calendar, TimeUnit $unit = null)
    {
        $range = TimeUnitIntervalFactory::rangeContaining(
            $calendar->getFirst()->getInterval()->getBegin(),
            $calendar->getLast()->getInterval()->getEnd(),
            $unit ?: TimeUnitFactory::year()
        );

        $collection = array();
        foreach ($range as $unitInterval) {
            $collection[] = new self($calendar, $unitInterval);
        }

        return $collection;
    }

    /**
     * @param CalendarInterface $calendar
     * @param TimeUnitInterval  $unitInterval
     */
    public function __construct(CalendarInterface $calendar, TimeUnitInterval $unitInterval)
    {
        $this->calendar = $calendar;
        $this->setUnitInterval($unitInterval);
    }

    /**
     * @return CalendarInterface
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * @param TimeUnitInterval $unitInterval
     */
    public function setUnitInterval(TimeUnitInterval $unitInterval)
    {
        $this->unitInterval = $unitInterval;
        $this->events = EventsExtractor::create($this->calendar->getEvents())
            ->after($unitInterval->getBegin())
            ->before($unitInterval->getEnd());
    }

    /**
     * @return TimeUnitInterval
     */
    public function getUnitInterval()
    {
        return $this->unitInterval;
    }

    /**
     * @param null|TimeUnit $unit
     *
     * @return CalendarUnit
     */
    public function getParent(TimeUnit $unit = null)
    {
        $unit = $unit ?: $this->unitInterval->getUnit()->getParent();

        return new self($this->calendar, $this->unitInterval->getParent($unit));
    }

    /**
     * @param null|TimeUnit $unit
     *
     * @return CalendarUnit[]
     */
    public function getChildren(TimeUnit $unit = null)
    {
        $unit = $unit ?: $this->unitInterval->getUnit()->getChild();

        $children = array();
        foreach ($this->unitInterval->getChildren($unit) as $childUnitInterval) {
            $children[] = new self($this->calendar, $childUnitInterval);
        }

        return $children;
    }
}
