<?php

namespace TimeMachine\Time\Model;

/**
 * Represents a time range boundary.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
final class TimeBoundary
{
    /**
     * @var TimePointInterface
     */
    private $point;

    /**
     * @var Boolean
     */
    private $inclusive;

    /**
     * Constructor.
     *
     * @param TimePointInterface $point
     * @param Boolean            $inclusive
     */
    public function __construct(TimePointInterface $point, $inclusive = true)
    {
        $this->point = $point;
        $this->inclusive = $inclusive;
    }

    /**
     * Returns boundary time point.
     *
     * @return TimePointInterface
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Returns true if boundary is inclusive.
     *
     * @return Boolean
     */
    public function isInclusive()
    {
        return $this->inclusive;
    }

    /**
     * Returns true if boundary is exclusive.
     *
     * @return Boolean
     */
    public function isExclusive()
    {
        return !$this->inclusive;
    }
}
