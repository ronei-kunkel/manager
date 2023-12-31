<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Contract;

interface EventProcessorInterface
{
  public function setEvent(EventInterface $event): void;
  public function event(): EventInterface;
  public function process(): void;
}