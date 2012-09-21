<?php

namespace Rouffj\Tests\Time;

use Rouffj\Tests\TestCase;

use Rouffj\Time\Core\TimePoint;
use Rouffj\Time\Core\TimeInterval;
use Rouffj\Time\Core\Calendar;
use Rouffj\Time\Core\EventProviderInterface;

class CalendarTest extends TestCase
{
    public function testDate()
    {
        new Calendar(new EventProvider());
    }
}

class EventProvider implements EventProviderInterface
{
    public function getEvents()
    {
        return array(
            new TimeInterval(new TimePoint(2012, 1, 15, 16, 0), new TimePoint(2012, 1, 15, 18, 30)),
            new TimeInterval(new TimePoint(2012, 1, 20, 8, 0), new TimePoint(2012, 1, 23, 8, 0)),
        );
    }
}
