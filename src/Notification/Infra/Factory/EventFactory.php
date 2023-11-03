<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Factory;

use Manager\Shared\Domain\Contract\Event;

final class EventFactory
{
  private array $factories = [];

  public function __construct()
  {
    $this->loadFactories();
  }

  public function loadFactories(): void
  {
    $this->factories = config('factories');
  }

  public function createGitHubEvent(array $data): Event
  {
    if (!isset($this->factories['github'][$data['event_type']])) {
      throw new \Exception('Unproccessable event', 422);
    }

    $invokableGitHubEventFactory = resolve($this->factories['github'][$data['event_type']], [$data]);

    return $invokableGitHubEventFactory($data);
  }
}
