<?php declare(strict_types=1);

namespace Manager\Notification\Application;

final readonly class NotificationOutput
{
  public function __construct(
    public int $code,
    public ?string $message = null
  ) {
  }
}