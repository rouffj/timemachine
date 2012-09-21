<?php

namespace Rouffj\Time\Factory;

use Rouffj\Time\Core\Date;

class DateFactory
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

