<?php

namespace TimeMachine\Calendar\Model;

/**
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface CalendarCursorInterface extends EventsListInterface
{
    function getCalendar();
    function getPoint();
}
