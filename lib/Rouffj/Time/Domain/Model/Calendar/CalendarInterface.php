<?php

namespace Rouffj\Time\Domain\Model\Calendar;

use Rouffj\Time\Domain\Model\Core\TimePoint;
use Rouffj\Time\Domain\Model\Core\TimeInterval;
use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Factory\TimePointFactory;
use Rouffj\Time\Domain\Service\EventProviderInterface;

/**
 * Calendar interface
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface CalendarInterface extends \Traversable, \Countable
{
    /**
     * @param TimeInterval $interval
     * @param string       $title
     *
     * @return Calendar
     */
    public function between(TimeInterval $interval, $title = '');

    /**
     * @param EventInterface $newEvent
     */
    public function add(EventInterface $newEvent);

    /**
     * @param EventInterface $event
     */
    public function remove(EventInterface $event);

    /**
     * @param StrategyInterface $strategy
     */
    public function setStrategy(StrategyInterface $strategy);

    /**
     * @return StrategyInterface
     */
    public function getStrategy();

    /**
     * @param TimePoint $cursor
     */
    public function setCursor(TimePoint $cursor);

    /**
     * @return TimePoint
     */
    public function getCursor();

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * {@inheritdoc}
     */
    public function count();

    /**
     * {@inheritdoc}
     */
    public function countRemaining();
}
