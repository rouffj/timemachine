<?php

namespace Rouffj\Time\Facade;

use Rouffj\Time\Core\CalendarInterval as BaseCalendarInterval;

class CalendarInterval extends BaseCalendarInterval
{
    static public function today()
    {
        $begin = \DateTime::createFromFormat('Y-m-d', $beginDate);

        return new CalendarDate(
            $now->format('Y'),
            $now->format('m'),
            $now->format('d')
        );
    }

    static public function create($begin, $end)
    {
        $begin = \DateTime::createFromFormat('Y-m-d', $begin);
        $begin = \DateTime::createFromFormat('Y-m-d', $end);

        return new CalendarInterval(
            new CalendarDate($begin->format('Y'), $begin->format('m'), $begin->format('d')),
            new CalendarDate($end->format('Y'), $end->format('m'), $end->format('d')),
        );
    }
}

