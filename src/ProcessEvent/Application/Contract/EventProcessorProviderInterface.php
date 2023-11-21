<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Contract;

use Manager\ProcessEvent\Domain\Contract\EventInterface;

interface EventProcessorProviderInterface
{
  public function setEvent(EventInterface $event): void;
  public function process(): void;
}