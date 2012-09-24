<?php

namespace Rouffj\Time\Domain\Factory;

use Rouffj\Time\Domain\Model\Core\Date;

class DateFactory
{
    static public function today()
    {
        $now = new \DateTime('now');

        return self::fromDateTime($now);
    }

    static public function fromDateTime(\DateTime $dateTime)
    {
        return new Date(
            $dateTime->format('Y'),
            $dateTime->format('m'),
            $dateTime->format('d')
        );
    }
}

