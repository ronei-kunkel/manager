<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Contract;

interface EventInterface
{
  public function getType(): string;
  public function getPlatform(): string;
  public function processor(): string;
  public function factory(): string;
}