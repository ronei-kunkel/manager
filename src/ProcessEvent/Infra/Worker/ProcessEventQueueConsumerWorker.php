<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Infra\Worker;

use Hyperf\Amqp\Consumer;
use Hyperf\Process\AbstractProcess;
use Manager\ProcessEvent\Infra\Queue\Consumer\ProcessEventConsumerMessage;
use Psr\Container\ContainerInterface;

final class ProcessEventQueueConsumerWorker extends AbstractProcess
{
  public function __construct(
    protected ContainerInterface $container,
    private Consumer $consumer,
    private ProcessEventConsumerMessage $eventReceivedConsumerMessage
  ) {
    parent::__construct($container);
  }

  public function handle(): never
  {
    while (true) {
      $this->consumer->consume($this->eventReceivedConsumerMessage);
    }
  }
}
