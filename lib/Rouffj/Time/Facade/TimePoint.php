<?php

namespace Rouffj\Time\Facade;

use Rouffj\Time\Core\TimePoint as BaseTimePoint;

class TimePoint extends BaseTimePoint
{
    static public function now()
    {
        $now = new \DateTime('now');

        return self::fromDateTime($now);
    }

    static public function fromTimestamp($timestamp)
    {
        $dtime = new \DateTime();
        $dtime->setTimestamp($timestamp);

        return self::fromDateTime($dtime);
    }

    static public function fromDateTime(\DateTime $dtime)
    {
        return new self(
            $dtime->format('Y'),
            $dtime->format('m'),
            $dtime->format('d'),
            $dtime->format('H'),
            $dtime->format('i'),
            $dtime->format('s')
        );
    }
}

