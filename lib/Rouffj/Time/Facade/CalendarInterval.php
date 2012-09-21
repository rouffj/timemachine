<?php

namespace Rouffj\Time\Facade;

use Rouffj\Time\Core\DateInterval as BaseCalendarInterval;

class DateInterval extends BaseCalendarInterval
{
    static public function today()
    {
        $begin = \DateTime::createFromFormat('Y-m-d', $beginDate);

        return new Date(
            $now->format('Y'),
            $now->format('m'),
            $now->format('d')
        );
    }

    static public function create($begin, $end)
    {
        $begin = \DateTime::createFromFormat('Y-m-d', $begin);
        $begin = \DateTime::createFromFormat('Y-m-d', $end);

        return new DateInterval(
            new Date($begin->format('Y'), $begin->format('m'), $begin->format('d')),
            new Date($end->format('Y'), $end->format('m'), $end->format('d')),
        );
    }
}

