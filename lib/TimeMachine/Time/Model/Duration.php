<?php

namespace TimeMachine\Time\Model;

class Duration
{
    private $value = null;
    private $type = null;

    public function __construct($duration, TimeUnit $type)
    {
        $this->value = $duration;
        $this->type = $type;
    }

    public function asPHPDateInterval()
    {
        $timeSpec = ($this->type->isTime()) ? 'PT' : 'P';
        $timeSpec = sprintf('%s%s%s', $timeSpec, $this->value, $this->type->getCode());

        return new \DateInterval($timeSpec);
    }

    public function getValue()
    {
        return $this->value;
    }
}
