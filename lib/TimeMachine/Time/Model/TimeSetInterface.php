<?php

namespace TimeMachine\Time\Model;

/**
 * Represents a set of time ranges.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface TimeSetInterface extends TimeRangeInterface
{
    /**
     * @return TimeRangeInterface[]
     */
    public function getRanges();

    /**
     * @return TimeRangeInterface
     */
    public function getRange();

    /**
     * @return Boolean
     */
    public function isContinuous();
}
