<?php

namespace Rouffj\Tests\Time;

use Rouffj\Time\Core\CalendarInterval;
use Rouffj\Time\Core\CalendarDate;
use Rouffj\Tests\TestCase;

use Rouffj\Time\Core\Calendar;
use Rouffj\Time\Extension\Calendar\FrancePublicHolidayProvider;

class PublicHolidayTest extends TestCase
{
    public function testCurrent()
    {
        $provider = new FrancePublicHolidayProvider(2012);
        $cal = new Calendar($provider);
        //$this->assertEquals(new CalendarDate(2012, 1, 1), $cal->next());

        //$cal->setDate(5, 1);
        //$this->assertEquals(new CalendarDate(2012, 5, 1), $cal->next());
        //$this->assertEquals(new CalendarDate(2012, 5, 8), $cal->next());
        //$this->assertEquals(null, $cal->next());
        //$this->assertEquals(null, $cal->next());

        $cal->setDate(12, 20);
        //$this->assertEquals(new CalendarDate(2012, 12, 25), $cal->next());
        //$this->assertEquals(null, $cal->next());
    }
}
