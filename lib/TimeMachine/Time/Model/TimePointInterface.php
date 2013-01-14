<?php

namespace TimeMachine\Time\Model;

/**
 * Represents a discrete time value.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface TimePointInterface extends ScopedObjectInterface
{
    /**
     * Returns point's scope.
     *
     * @return TimeScope
     */
    public function getScope();

    /**
     * Returns true if current point precedes given point.
     *
     * @param TimePointInterface $point
     *
     * @return Boolean
     */
    public function precedes(TimePointInterface $point);

    /**
     * Returns true if current point is equal to given point.
     *
     * @param TimePointInterface $point
     *
     * @return Boolean
     */
    public function equals(TimePointInterface $point);

    /**
     * Returns true if current point succeeds given point.
     *
     * @param TimePointInterface $point
     *
     * @return Boolean
     */
    public function succeeds(TimePointInterface $point);
}
