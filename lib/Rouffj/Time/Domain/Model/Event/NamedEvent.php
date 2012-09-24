<?php

namespace Rouffj\Time\Domain\Model\Event;

use Rouffj\Time\Domain\Model\Core\TimeInterval;

class NamedEvent extends Event implements NamedEventInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @param TimeInterval $interval
     * @param string       $title
     */
    public function __construct(TimeInterval $interval, $title)
    {
        parent::__construct($interval);
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }
}