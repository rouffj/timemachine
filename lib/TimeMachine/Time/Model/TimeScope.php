<?php

namespace TimeMachine\Time\Model;

/**
 * Represents scope of a scoped time object.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
final class TimeScope
{
    const DAY   = 4;
    const WEEK  = 3;
    const MONTH = 2;
    const YEAR  = 1;
    const ALL   = 0;

    private $rank;

    /**
     * Constructor.
     *
     * @param int $rank
     */
    public function __construct($rank = self::ALL)
    {
        $this->rank = $rank;
    }
}
