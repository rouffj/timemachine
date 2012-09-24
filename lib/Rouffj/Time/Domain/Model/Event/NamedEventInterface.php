<?php

namespace Rouffj\Time\Domain\Model\Event;

interface NamedEventInterface extends EventInterface
{
    /**
     * @return string
     */
    function getTitle();

    /**
     * @return string
     */
    function getDescription();
}
