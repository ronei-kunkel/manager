<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Base;
use Manager\ProcessEvent\Domain\Contract\EventInterface;

abstract class EventProcessor
{
  protected EventInterface $event;

  public function setEvent(EventInterface $event): void
  {
    $this->event = $event;
  }

  /**
   * Override this return with the target event that implements the EventInterface
   */
  abstract protected function getEvent(): EventInterface;
}