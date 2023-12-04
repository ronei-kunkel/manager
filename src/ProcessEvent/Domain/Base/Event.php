<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Base;

use Manager\ProcessEvent\Domain\Contract\EventInterface;

abstract class Event implements EventInterface
{
  public function __construct(
    protected string $type,
    protected string $platform,
    protected array $content
  ) {
    $this->populate();
  }

  public function getType(): string
  {
    return $this->type;
  }

  public function getPlatform(): string
  {
    return $this->platform;
  }

  abstract protected function populate(): void;
}