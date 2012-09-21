<?php

namespace Rouffj\Tests\Time\Calendar;

use Rouffj\Tests\TestCase;

use Rouffj\Time\Core\TimePoint;
use Rouffj\Time\Core\TimeInterval;
use Rouffj\Time\Calendar\Calendar;
use Rouffj\Time\Calendar\EventProviderInterface;
use Rouffj\Time\Calendar\EventInterface;
use Rouffj\Time\Calendar\Event;

class CalendarTest extends TestCase
{
    public function testConstructor()
    {
        $calendar = new Calendar(new EventProvider());

        $this->assertCount(2, $calendar);
        foreach ($calendar as $event) {
            $this->assertTrue($event instanceof EventInterface);
        }
    }

    public function testDefaultCursor()
    {
        $calendar = new Calendar(new EventProvider());
        $cursor = new TimePoint(2012, 1, 15, 16, 0);
        $this->assertEquals($cursor, $calendar->getCursor());
    }

    public function testCursorFiltering()
    {
        $calendar = new Calendar(new EventProvider());

        $calendar->setCursor(new TimePoint(2012, 1, 15, 15, 59));
        $this->assertCount(2, $calendar);

        $calendar->setCursor(new TimePoint(2012, 1, 17, 0, 0));
        $this->assertCount(1, $calendar);

        $calendar->setCursor(new TimePoint(2012, 1, 23, 8, 1));
        $this->assertSame(0, count($calendar));
    }
}

class EventProvider implements EventProviderInterface
{
    public function getEvents()
    {
        return array(
            new Event(new TimeInterval(new TimePoint(2012, 1, 15, 16, 0), new TimePoint(2012, 1, 15, 18, 30))),
            new Event(new TimeInterval(new TimePoint(2012, 1, 20, 8, 0), new TimePoint(2012, 1, 23, 8, 0))),
        );
    }

    public function getName()
    {
        return 'test';
    }
}
