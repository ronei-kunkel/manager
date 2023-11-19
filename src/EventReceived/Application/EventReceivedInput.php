<?php declare(strict_types=1);

namespace Manager\EventReceived\Application;

use stdClass;

final readonly class EventReceivedInput
{
  public function __construct(
    public array $headers,
    public array $body
  ) {
  }
}