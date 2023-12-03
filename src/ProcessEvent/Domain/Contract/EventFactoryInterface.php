<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Contract;

interface EventFactoryInterface
{
  public function make(string $type, string $platform, array $content): EventInterface;
}