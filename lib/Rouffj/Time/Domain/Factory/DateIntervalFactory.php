<?php

namespace Rouffj\Time\Factory;

use Rouffj\Time\Domain\Model\Date;
use Rouffj\Time\Domain\Model\DateInterval;

class DateIntervalFactory
{
    static public function today()
    {
        $now = new \DateTime();

        return new Date(
            $now->format('Y'),
            $now->format('m'),
            $now->format('d')
        );
    }

    static public function create($begin, $end)
    {
        $begin = \DateTime::createFromFormat('Y-m-d', $begin);
        $end = \DateTime::createFromFormat('Y-m-d', $end);

        return new DateInterval(
            new Date($begin->format('Y'), $begin->format('m'), $begin->format('d')),
            new Date($end->format('Y'), $end->format('m'), $end->format('d'))
        );
    }
}

