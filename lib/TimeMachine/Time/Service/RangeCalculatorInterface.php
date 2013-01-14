<?php

namespace TimeMachine\Time\Service;

use TimeMachine\Time\Model\TimeRangeInterface;

/**
 * Computes time range operations.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface RangeCalculatorInterface
{
    /**
     * Computes intersection of two time ranges.
     *
     * @param TimeRangeInterface $a
     * @param TimeRangeInterface $b
     *
     * @return TimeRangeInterface
     */
    public function intersection(TimeRangeInterface $a, TimeRangeInterface $b);

    /**
     * Computes union of two time ranges.
     *
     * @param TimeRangeInterface $a
     * @param TimeRangeInterface $b
     *
     * @return TimeSetInterface
     */
    public function union(TimeRangeInterface $a, TimeRangeInterface $b);
}
