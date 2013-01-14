<?php

namespace TimeMachine\Time\Service;

use TimeMachine\Time\Model\TimePointInterface;
use TimeMachine\Time\Model\TimeDurationInterface;

/**
 * Formats a time objects into human sentence.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface FormatterInterface
{
    /**
     * Formats a time point into human sentence.
     *
     * @param TimePointInterface $point
     *
     * @return string
     */
    public function formatPoint(TimePointInterface $point);

    /**
     * Formats a time duration into human sentence.
     *
     * @param TimeDurationInterface $duration
     *
     * @return string
     */
    public function formatDuration(TimeDurationInterface $duration);
}
