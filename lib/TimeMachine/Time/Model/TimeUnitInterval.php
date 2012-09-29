<?php

namespace TimeMachine\Time\Model;

use TimeMachine\Time\Factory\TimePointFactory;
use TimeMachine\Time\Factory\TimeUnitIntervalFactory;

class TimeUnitInterval extends TimeInterval
{
    const ORIGIN = '0000-01-01 00:00:00';

    /**
     * Unit of time.
     *
     * @var TimeUnit
     */
    private $unit;

    /**
     * Index starting with 0.
     *
     * @var int
     */
    private $index;

    /**
     * @param TimeUnit $unit  Unit of time
     * @param int      $index Index since origin (0 based)
     */
    public function __construct(TimeUnit $unit, $index)
    {
        $this->unit  = $unit;
        $this->index = $index;

        parent::__construct(
            TimePointFactory::fromDateTime($this->buildDateTime($index)),
            TimePointFactory::fromDateTime($this->buildDateTime($index + 1, true))
        );
    }

    /**
     * @return TimeUnit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param int $step
     *
     * @return TimeUnitInterval
     */
    public function getNext($step = 1)
    {
        return new self($this->unit, $this->index + $step);
    }

    /**
     * @param int $step
     *
     * @return TimeUnitInterval
     */
    public function getPrevious($step = 1)
    {
        return new self($this->unit, $this->index - $step);
    }

    /**
     * @param TimeUnit $unit
     *
     * @return TimeUnitInterval
     */
    public function getParent(TimeUnit $unit)
    {
        if (!$unit->isParentOf($this->unit)) {
            throw new \LogicException(sprintf('"%s" is not a parent of "%s".', $unit->getName(), $this->unit->getName()));
        }

        return TimeUnitIntervalFactory::containing($this->getBegin(), $unit);
    }

    /**
     * @param TimeUnit $unit
     *
     * @return array
     */
    public function getChildren(TimeUnit $unit)
    {
        return TimeUnitIntervalFactory::rangeContaining($this->getBegin(), $this->getEnd(), $unit);
    }

    /**
     * @param int  $index
     * @param bool $minusOneSecond
     *
     * @return \DateTime
     */
    private function buildDateTime($index, $minusOneSecond = false)
    {
        return new \DateTime(sprintf(
            '%s %s %d %s%s %s',
            self::ORIGIN,
            $index < 0 ? '-' : '+',
            abs($index),
            $this->unit->getName(),
            abs($index) > 1 ? 's' : '',
            $minusOneSecond ? '- 1 second' : ''
        ));
    }
}

