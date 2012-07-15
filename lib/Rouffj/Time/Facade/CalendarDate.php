<?php

namespace Rouffj\Time\Facade;

use Rouffj\Time\Core\CalendarDate as BaseCalendarDate;

class CalendarDate extends BaseCalendarDate
{
    static public function today()
    {
        $now = new \DateTime('now');

        return self::fromDateTime($now);
    }

    static public function fromDateTime(\DateTime $dtime)
    {
        return new CalendarDate(
            $dtime->format('Y'),
            $dtime->format('m'),
            $dtime->format('d')
        );
    }
}

