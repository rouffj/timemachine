<?php

namespace TimeMachine\Time\Model;

class TimeUnit
{
    const YEAR   = 'Y';
    const MONTH  = 'M';
    const WEEK   = 'W';
    const DAY    = 'D';
    const HOUR   = 'H';
    const MINUTE = 'I';
    const SECOND = 'S';

    private $type = null;

    private static $names = array(
        'Y' => 'year',
        'M' => 'month',
        'W' => 'week',
        'D' => 'day',
        'H' => 'hour',
        'I' => 'minute',
        'S' => 'second',
    );

    private function __construct($type)
    {
        if (!isset(self::$names[$type])) {
            throw new \LogicException(sprintf('Invalid type "%s", valid choices are %s.', $type, implode(', ', array_keys(self::$names))));
        }

        $this->type = $type;
    }

    public function getCode()
    {
        return (self::MINUTE === $this->type) ? 'M' : $this->type;
    }

    public function getIntervalProperty()
    {
        return strtolower($this->type);
    }

    public function getName()
    {
        return self::$names[$this->type];
    }

    public function getRank()
    {
        $ranks = array_keys(self::$names);

        return $ranks[$this->type];
    }

    public function isTime()
    {
        return
            self::HOUR === $this->type ||
            self::MINUTE === $this->type ||
            self::SECOND === $this->type
        ;
    }

    public function isParentOf(TimeUnit $unit)
    {
        return $unit->getRank() < $this->getRank();
    }
}
