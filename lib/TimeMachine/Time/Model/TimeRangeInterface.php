<?php

namespace TimeMachine\Time\Model;

/**
 * Represents a continuous time segment.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface TimeRangeInterface extends ScopedObjectInterface
{
    /**
     * Returns range start boundary.
     *
     * @return TimeBoundary
     */
    public function getStart();

    /**
     * Returns range end boundary.
     *
     * @return TimeBoundary
     */
    public function getEnd();

    /**
     * Returns range duration.
     *
     * @return TimeDurationInterface
     */
    public function getDuration();
}
