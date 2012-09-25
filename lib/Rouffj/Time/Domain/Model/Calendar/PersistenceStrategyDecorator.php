<?php

namespace Rouffj\Time\Domain\Model\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Service\EventPersisterInterface;

/**
 * Base strategy which permit everything.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class PersistenceStrategyDecorator implements StrategyInterface
{
    /**
     * @var StrategyInterface
     */
    private $innerStrategy;

    /**
     * @var EventPersisterInterface
     */
    private $persister;

    /**
     * @param StrategyInterface       $innerStrategy
     * @param EventPersisterInterface $persister
     */
    public function __construct(StrategyInterface $innerStrategy, EventPersisterInterface $persister)
    {
        $this->innerStrategy = $innerStrategy;
        $this->persister     = $persister;
    }

    /**
     * {@inheritdoc}
     */
    public function add(EventInterface $newEvent, array $events)
    {
        $result = $this->innerStrategy->add($newEvent, $events);
        $this->persister->addEvent($newEvent);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EventInterface $removedEvent, array $events)
    {
        $result = $this->innerStrategy->remove($removedEvent, $events);
        $this->persister->removeEvent($removedEvent);

        return $result;
    }
}
