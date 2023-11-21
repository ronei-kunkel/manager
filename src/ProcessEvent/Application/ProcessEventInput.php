<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application;

final readonly class ProcessEventInput
{
  public function __construct(
    public string $type,
    public string $platform,
    public array $content
  ) {
  }
}