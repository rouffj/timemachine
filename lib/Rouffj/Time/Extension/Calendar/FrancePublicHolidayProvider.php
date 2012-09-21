<?php

namespace Rouffj\Time\Extension\Calendar;

use Rouffj\Time\Core\DateProviderInterface;
use Rouffj\Time\Core\Date;

/**
 * 
 *
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class FrancePublicHolidayProvider implements DateProviderInterface
{
    private $year;

    function __construct($year)
    {
        $this->year = $year;
    }

    public function getDates()
    {
        return array(
            new Date(2012, 1, 1),
            new Date(2012, 5, 1),
            new Date(2012, 5, 8),
        );
    }

    /**
     * Gets the value of year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }
}
