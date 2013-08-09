<?php

namespace TimeMachine\Time\Model;

class TimeUnit
{
    const YEAR = 'Y';
    const MONTH = 'M';
    const DAY = 'D';
    const HOUR = 'H';
    const MINUTE = 'I';
    const SECOND = 'S';

    private $unit;

    private function __construct($unit)
    {
        $this->unit = $unit;
    }

    public function getCode()
    {
        return (self::MINUTE === $this->unit) ? 'M' : $this->type;
    }

    public function isTime()
    {
        return
            self::HOUR === $this->unit ||
            self::MINUTE === $this->unit ||
            self::SECOND === $this->unit
        ;
    }

    static public function year()
    {
        return new self(self::YEAR);
    }

    static public function month()
    {
        return new self(self::MONTH);
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
