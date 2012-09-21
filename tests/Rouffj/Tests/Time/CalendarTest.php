<?php

namespace Rouffj\Tests\Time;

use Rouffj\Time\Core\CalendarInterval;
use Rouffj\Time\Core\CalendarDate;
use Rouffj\Tests\TestCase;

use Rouffj\Time\Core\Calendar;
use Rouffj\Time\Extension\Calendar\FrancePublicHolidayProvider;

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
            new TimeInterval(new TimePoint(2012, 1, 15, 16, 0), new TimePoint(2012, 1, 15, )),
        );
    }
}
