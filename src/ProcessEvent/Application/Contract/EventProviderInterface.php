<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Contract;

use Manager\ProcessEvent\Domain\Contract\EventInterface;

interface EventProviderInterface
{
  public function make(string $type, string $platform, array $content): EventInterface;
}