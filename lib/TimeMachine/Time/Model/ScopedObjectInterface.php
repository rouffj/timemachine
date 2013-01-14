<?php

namespace TimeMachine\Time\Model;

/**
 * Represents a scoped time object.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface ScopedObjectInterface
{
    /**
     * Returns object's scope.
     *
     * @return TimeScope
     */
    public function getScope();
}
