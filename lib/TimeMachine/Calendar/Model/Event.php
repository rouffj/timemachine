<?php

namespace TimeMachine\Calendar\Model;

use TimeMachine\Time\Model\TimeInterval;

class Event implements EventInterface
{
    /**
     * @var TimeInterval
     */
    private $interval;

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
     *
     * @param string $title
     */
    public function __construct(TimeInterval $interval, $title = '')
    {
        $this->interval    = $interval;
        $this->title       = $title;
        $this->description = '';
    }

    /**
     * {@inheritdoc}
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(EventInterface $event)
    {
        return $this->interval->getBegin()->equals($event->getInterval()->getBegin())
            && $this->interval->getEnd()->equals($event->getInterval()->getEnd());
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
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
