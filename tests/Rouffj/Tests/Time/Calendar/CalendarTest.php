<?php

namespace Rouffj\Tests\Time\Calendar;

use Rouffj\Tests\TestCase;
use Rouffj\Time\Domain\Model\Calendar\Calendar;
use Rouffj\Time\Domain\Model\Calendar\NoOverlapStrategy;
use Rouffj\Time\Domain\Model\Core\TimePoint;
use Rouffj\Time\Domain\Model\Core\TimeInterval;
use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Model\Event\Event;
use Rouffj\Time\Domain\Factory\TimeIntervalFactory;
use Rouffj\Time\Domain\Exception\CalendarEventException;

class CalendarTest extends TestCase
{
    /**
     * @var Calendar
     */
    private $calendar;

    public function setup()
    {
        $this->calendar = new Calendar('foo calendar', array(
            new Event(TimeIntervalFactory::create('2012-01-15 16:00', '2012-01-15 18:30')),
            new Event(TimeIntervalFactory::create('2012-01-20 08:00', '2012-01-23 08:00')),
        ));
    }

    public function testConstructor()
    {
        $this->assertCount(2, $this->calendar);
        foreach ($this->calendar as $event) {
            $this->assertTrue($event instanceof EventInterface);
        }
    }

    public function testDefaultCursor()
    {
        $cursor = new TimePoint(2012, 1, 15, 16, 0);
        $this->assertEquals($cursor, $this->calendar->getCursor());
    }

    public function testCursorFiltering()
    {
        $this->calendar->setCursor(new TimePoint(2012, 1, 15, 15, 59));
        $this->assertSame(2, $this->calendar->countRemaining());

        $this->calendar->setCursor(new TimePoint(2012, 1, 17, 0, 0));
        $this->assertSame(1, $this->calendar->countRemaining());

        $this->calendar->setCursor(new TimePoint(2012, 1, 23, 8, 1));
        $this->assertSame(0, $this->calendar->countRemaining());
    }

    public function testBetween()
    {
        $this->assertCount(0, $this->calendar->between(new TimeInterval(new TimePoint(2012, 1, 1, 0, 0), new TimePoint(2012, 1, 15, 15, 59, 59))));
        $this->assertCount(1, $this->calendar->between(new TimeInterval(new TimePoint(2012, 1, 1, 0, 0), new TimePoint(2012, 1, 15, 16, 1, 0))));

        $this->assertCount(0, $this->calendar->between(new TimeInterval(new TimePoint(2012, 1, 23, 8, 0, 1), new TimePoint(2012, 2, 0, 0, 0))));
        $this->assertCount(1, $this->calendar->between(new TimeInterval(new TimePoint(2012, 1, 20, 7, 59, 59), new TimePoint(2012, 2, 0, 0, 0))));

        $this->assertCount(0, $this->calendar->between(new TimeInterval(new TimePoint(2012, 1, 15, 18, 30, 1), new TimePoint(2012, 1, 20, 7, 59, 59))));
        $this->assertCount(2, $this->calendar->between(new TimeInterval(new TimePoint(2012, 1, 15, 18, 29, 59), new TimePoint(2012, 1, 20, 8, 0, 1))));
    }

    public function testAdd()
    {
        $this->assertCount(2, $this->calendar);

        $this->calendar->add(new Event(TimeIntervalFactory::create('2012-01-01 20:00', '2012-01-01 21:59')));
        $this->assertCount(3, $this->calendar);

        // AllowOverlapStrategy
        $this->calendar->add(new Event(TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 19:59')));
        $this->assertCount(4, $this->calendar);
        $this->assertCount(2, $this->calendar->between(TimeIntervalFactory::create('2012-01-01 19:30', '2012-01-01 21:30')));
    }

    public function testUpdate()
    {
        $originalEvent = current(iterator_to_array($this->calendar));
        $updatedEvent  = new Event(TimeIntervalFactory::create('2012-01-15 17:00', '2012-01-15 19:30'));
        $this->calendar->update($originalEvent, $updatedEvent);

        $this->assertCount(2, $this->calendar);
        $this->assertSame($updatedEvent, current(iterator_to_array($this->calendar)));
    }

    public function testAddWithNoOverlapStrategy()
    {
        $this->calendar->setStrategy(new NoOverlapStrategy());
        $this->assertCount(2, $this->calendar);

        $this->calendar->add(new Event(TimeIntervalFactory::create('2012-01-15 15:30', '2012-01-15 15:59')));
        $this->assertCount(3, $this->calendar);

        try {
            $this->calendar->add(new Event(TimeIntervalFactory::create('2012-01-15 15:00', '2012-01-15 15:40')));
            $this->fail('A CalendarEventException should be thrown');
        } catch (CalendarEventException $e) {
        }

        try {
            // exact same Event as reference
            $this->calendar->add(new Event(TimeIntervalFactory::create('2012-01-15 15:30', '2012-01-15 15:59')));
            $this->fail('A CalendarEventException should be thrown');
        } catch (CalendarEventException $e) {
        }

        $this->calendar->add(new Event(TimeIntervalFactory::create('2012-01-16 17:50', '2012-01-17 18:00')));
        $this->assertCount(4, $this->calendar);
    }
}
