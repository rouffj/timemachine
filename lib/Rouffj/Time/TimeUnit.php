<?php

namespace Rouffj\Time;

class TimeUnit
{
    const YEAR = 'Y';
    const MONTH = 'M';
    const DAY = 'D';
    const HOUR = 'H';
    const MINUTE = 'M';
    const SECOND = 'S';
    private $type = null;

    private function __construct($type)
    {
        $this->type = $type;
    }

    public function getCode()
    {
        return $this->type;
    }

    public function isTime()
    {
        return
            self::HOUR === $this->type ||
            self::MINUTE === $this->type ||
            self::SECOND === $this->type
        ;
    }

    static public function day()
    {
        return new self(self::DAY);
    }

    static public function hour()
    {
        return new self(self::HOUR);
    }

    static public function minute()
    {
        return new self(self::MINUTE);
    }
}
