<?php

namespace Rouffj\Time\Domain\Model;

class TimeUnit
{
    const YEAR = 'Y';
    const MONTH = 'M';
    const DAY = 'D';
    const HOUR = 'H';
    const MINUTE = 'I';
    const SECOND = 'S';

    private $type = null;

    private function __construct($type)
    {
        $this->type = $type;
    }

    public function getCode()
    {
        return (self::MINUTE === $this->type) ? 'M' : $this->type;
    }

    public function isTime()
    {
        return
            self::HOUR === $this->type ||
            self::MINUTE === $this->type ||
            self::SECOND === $this->type
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
