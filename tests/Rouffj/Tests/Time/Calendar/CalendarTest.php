<?php

namespace Rouffj\Tests\Time\Calendar;

use Rouffj\Tests\TestCase;
use TimeMachine\Calendar\Model\Calendar;
use TimeMachine\Calendar\Model\BaseStrategy;
use TimeMachine\Calendar\Model\NoOverlapStrategy;
use TimeMachine\Time\Model\TimePoint;
use TimeMachine\Time\Model\TimeInterval;
use TimeMachine\Calendar\Model\EventInterface;
use TimeMachine\Calendar\Model\Event;
use TimeMachine\Time\Factory\TimeIntervalFactory;
use TimeMachine\Calendar\Exception\CalendarEventException;
use TimeMachine\Calendar\Service\EventProviderInterface;

class CalendarTest extends TestCase
{
    public function testConstructor()
    {
        $calendar = new Calendar(new BaseStrategy(), new EventProvider());

        $this->assertCount(2, $calendar);
        foreach ($calendar as $event) {
            $this->assertTrue($event instanceof EventInterface);
        }
    }

    public function testDefaultCursor()
    {
        $calendar = new Calendar(new BaseStrategy(), new EventProvider());
        $cursor = new TimePoint(2012, 1, 15, 16, 0);
        $this->assertEquals($cursor, $calendar->getCursor());
    }

    public function testCursorFiltering()
    {
        $calendar = new Calendar(new BaseStrategy(), new EventProvider());

        $calendar->setCursor(new TimePoint(2012, 1, 15, 15, 59));
        $this->assertSame(2, $calendar->countRemaining());

        $calendar->setCursor(new TimePoint(2012, 1, 17, 0, 0));
        $this->assertSame(1, $calendar->countRemaining());

        $calendar->setCursor(new TimePoint(2012, 1, 23, 8, 1));
        $this->assertSame(0, $calendar->countRemaining());
    }

    public function testBetween()
    {
        $calendar = new Calendar(new BaseStrategy(), new EventProvider());

        $this->assertCount(0, $calendar->between(new TimeInterval(new TimePoint(2012, 1, 1, 0, 0), new TimePoint(2012, 1, 15, 15, 59, 59))));
        $this->assertCount(1, $calendar->between(new TimeInterval(new TimePoint(2012, 1, 1, 0, 0), new TimePoint(2012, 1, 15, 16, 1, 0))));

        $this->assertCount(0, $calendar->between(new TimeInterval(new TimePoint(2012, 1, 23, 8, 0, 1), new TimePoint(2012, 2, 0, 0, 0))));
        $this->assertCount(1, $calendar->between(new TimeInterval(new TimePoint(2012, 1, 20, 7, 59, 59), new TimePoint(2012, 2, 0, 0, 0))));

        $this->assertCount(0, $calendar->between(new TimeInterval(new TimePoint(2012, 1, 15, 18, 30, 1), new TimePoint(2012, 1, 20, 7, 59, 59))));
        $this->assertCount(2, $calendar->between(new TimeInterval(new TimePoint(2012, 1, 15, 18, 29, 59), new TimePoint(2012, 1, 20, 8, 0, 1))));
    }

    public function testAdd()
    {
        $calendar = new Calendar(new BaseStrategy(), new EventProvider());
        $this->assertCount(2, $calendar);

        $calendar->add(new Event(TimeIntervalFactory::create('2012-01-01 20:00', '2012-01-01 21:59')));
        $this->assertCount(3, $calendar);

        // AllowOverlapStrategy
        $calendar->add(new Event(TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 19:59')));
        $this->assertCount(4, $calendar);
        $this->assertCount(2, $calendar->between(TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 21:30')));
    }

    public function testAddWithNoOverlapStrategy()
    {
        $calendar = new Calendar(new NoOverlapStrategy(), new EventProvider());
        $this->assertCount(2, $calendar);

        $calendar->add(new Event(TimeIntervalFactory::create('2012-01-15 15:30', '2012-01-15 15:59')));
        $this->assertCount(3, $calendar);

        try {
            $calendar->add(new Event(TimeIntervalFactory::create('2012-01-15 15:00', '2012-01-15 15:40')));
            $this->fail('A CalendarEventException should be thrown');
        } catch (CalendarEventException $e) {
        }
        try {
            // exact same Event as reference
            $calendar->add(new Event(TimeIntervalFactory::create('2012-01-15 15:30', '2012-01-15 15:59')));
            $this->fail('A CalendarEventException should be thrown');
        } catch (CalendarEventException $e) {
        }

        $calendar->add(new Event(TimeIntervalFactory::create('2012-01-16 17:50', '2012-01-17 18:00')));
        $this->assertCount(4, $calendar);
    }
}

class EventProvider implements EventProviderInterface
{
    public function getEvents()
    {
        return array(
            new Event(TimeIntervalFactory::create('2012-01-15 16:00', '2012-01-15 18:30')),
            new Event(TimeIntervalFactory::create('2012-01-20 08:00', '2012-01-23 08:00')),
        );
    }

    public function getName()
    {
        return 'test';
    }
}
