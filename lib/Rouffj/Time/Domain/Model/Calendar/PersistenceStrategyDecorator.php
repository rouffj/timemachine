<?php

namespace Rouffj\Time\Domain\Model\Calendar;

use Rouffj\Time\Domain\Model\Event\EventInterface;
use Rouffj\Time\Domain\Service\EventPersisterInterface;

/**
 * Strategy decorator with persister.
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
        $this->persister->add($newEvent);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EventInterface $removedEvent, array $events)
    {
        $result = $this->innerStrategy->remove($removedEvent, $events);
        $this->persister->remove($removedEvent);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update(EventInterface $originalEvent, EventInterface $updatedEvent, array $events)
    {
        return $this->innerStrategy->update($originalEvent, $updatedEvent, $events);
    }
}
