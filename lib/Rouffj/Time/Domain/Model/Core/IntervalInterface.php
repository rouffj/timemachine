<?php

namespace Rouffj\Time\Domain\Model;

/**
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
interface IntervalInterface
{
    function getBegin();
    function getEnd();
    function isBefore(IntervalInterface $interval);
    function isAfter(IntervalInterface $interval);
    function isDuring(IntervalInterface $interval);
}
