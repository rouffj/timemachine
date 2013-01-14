<?php

namespace TimeMachine\Time\Service;

use TimeMachine\Time\Model\ScopedObjectInterface;
use TimeMachine\Time\Model\TimePointInterface;
use TimeMachine\Time\Model\TimeScope;

/**
 * Performs scope transformation on scoped time objects.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface ScopeTransformerInterface
{
    /**
     * Decreases scope rank.
     *
     * @param ScopedObjectInterface $point
     * @param TimeScope             $scope
     *
     * @return ScopedObjectInterface
     */
    public function decrease(ScopedObjectInterface $point, TimeScope $scope);

    /**
     * Increases scope rank.
     *
     * @param ScopedObjectInterface $point
     * @param TimeScope             $scope
     * @param TimePointInterface    $offset
     *
     * @return ScopedObjectInterface
     */
    public function increase(ScopedObjectInterface $point, TimeScope $scope, TimePointInterface $offset);
}
