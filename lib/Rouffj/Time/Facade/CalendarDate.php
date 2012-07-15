<?php

namespace Rouffj\Time\Facade;

use Rouffj\Time\Core\CalendarDate as BaseCalendarDate;

class CalendarDate extends BaseCalendarDate
{
    static public function today()
    {
        $now = new \DateTime('now');

        return new CalendarDate(
            $now->format('Y'),
            $now->format('m'),
            $now->format('d')
        )
    }
}

