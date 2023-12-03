<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Event\Ping;

use Manager\ProcessEvent\Domain\Contract\EventInterface;
use Manager\ProcessEvent\Domain\Base\Event;

final class PingEvent extends Event implements EventInterface
{
  private int $appId;

  public function processor(): string
  {
    return PingEventProcessor::class;
  }

  public function factory(): string
  {
    return PingEventFactory::class;
  }

  protected function populate(): void
  {
    $this->appId = $this->content['hook']['app_id'];
  }

  public function getAppId(): int
  {
    return $this->appId;
  }
}
