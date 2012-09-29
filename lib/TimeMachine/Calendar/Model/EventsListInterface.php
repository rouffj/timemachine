<?php

namespace TimeMachine\Calendar\Model;

/**
 * Events list interface.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface EventsListInterface  extends \IteratorAggregate, \Countable, \ArrayAccess
{
    /**
     * @return EventInterface[]
     */
    function getEvents();

    /**
     * @return EventInterface
     */
    function getFirst();

    /**
     * @return EventInterface
     */
    function getLast();
}
