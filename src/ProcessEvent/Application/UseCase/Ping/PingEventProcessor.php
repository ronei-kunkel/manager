<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\UseCase\Ping;

use Manager\ProcessEvent\Application\Base\EventProcessor;
use Manager\ProcessEvent\Application\Contract\EventProcessorProviderInterface;
use Manager\ProcessEvent\Domain\Entity\PingEvent;

final class PingEventProcessor extends EventProcessor implements EventProcessorProviderInterface
{
  protected function getEvent(): PingEvent
  {
    return $this->event;
  }

  public function process(): void
  {
    $this->getEvent()->getAppId();
  }
}
