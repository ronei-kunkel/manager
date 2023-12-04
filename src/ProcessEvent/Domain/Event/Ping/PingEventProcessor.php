<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Event\Ping;

use Manager\ProcessEvent\Infra\Service\PublishMessageService;
use Manager\ProcessEvent\Domain\Base\EventProcessor;
use Manager\ProcessEvent\Domain\Contract\EventProcessorInterface;
use Manager\ProcessEvent\Infra\Queue\Producer\EventProcessedMessage;

final class PingEventProcessor extends EventProcessor implements EventProcessorInterface
{
  public function __construct(
    private PublishMessageService $publishMessageService,
    private EventProcessedMessage $message
  ) {
  }

  public function event(): PingEvent
  {
    return $this->event;
  }

  public function process(): void
  {
    try {
      $this->message->setPayload(['appId' => $this->event()->getAppId()]);
      $this->publishMessageService->publish($this->message);
    } catch (\Throwable $th) {
      print_r($th->getMessage());
    }
  }
}
