<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Event\Ping;

use Hyperf\Amqp\Producer;
use Manager\ProcessEvent\Domain\Base\EventProcessor;
use Manager\ProcessEvent\Domain\Contract\EventProcessorInterface;
use Manager\ProcessEvent\Infra\Queue\Producer\EventProcessedMessage;
use Psr\Container\ContainerInterface;

final class PingEventProcessor extends EventProcessor implements EventProcessorInterface
{
  private Producer $producer;

  /**
   * @todo pass the prodicer to service
   */
  public function __construct(
    private service
    private ContainerInterface $container,
    private EventProcessedMessage $message
  ) {
    $this->producer = $container->get(Producer::class);
  }

  public function getEvent(): PingEvent
  {
    return $this->event;
  }

  public function process(): void
  {
    /** 
     * @todo each notification must be processed accordingly
     */
    try {
      $this->message->setPayload(['appId' => $this->getEvent()->getAppId()]);
      $this->producer->produce($this->message);
    } catch (\Throwable $th) {
      print_r($th->getMessage());
    }
  }
}
