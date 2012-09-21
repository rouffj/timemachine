<?php

namespace Rouffj\Time\Facade;

use Rouffj\Time\Core\Date as BaseCalendarDate;

class Date extends BaseCalendarDate
{
    static public function today()
    {
        $now = new \DateTime('now');

        return self::fromDateTime($now);
    }

    static public function fromDateTime(\DateTime $dtime)
    {
        return new Date(
            $dtime->format('Y'),
            $dtime->format('m'),
            $dtime->format('d')
        );
    }
}

