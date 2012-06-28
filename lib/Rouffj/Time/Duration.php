<?php

namespace Rouffj\Time;

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
        $code = $this->type->getCode();
        $timeSpec = ($this->type->isTime()) ? 'PT' : 'P';
        $timeSpec = sprintf('%s%s%s', $timeSpec, $this->value, $this->type->getCode());
        //echo $timeSpec."\n";

        return new \DateInterval($timeSpec);
    }
}
