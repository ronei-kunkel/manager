<?php declare(strict_types=1);

namespace Manager\EventReceived\Domain\Entity;

final class Event
{
  public function __construct(
    private string $type,
    private string $platform,
    private array $content
  ) {
  }

  public function data(): array
  {
    return [
      'type' => $this->type,
      'platform' => $this->platform,
      'content' => $this->content
    ];
  }
}