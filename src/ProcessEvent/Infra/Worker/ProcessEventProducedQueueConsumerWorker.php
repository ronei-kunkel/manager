<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Infra\Worker;

use Hyperf\Amqp\Consumer;
use Hyperf\Process\AbstractProcess;
use Manager\ProcessEvent\Infra\Queue\Consumer\ProcessEventProcessedConsumerMessage;
use Psr\Container\ContainerInterface;

final class ProcessEventProducedQueueConsumerWorker extends AbstractProcess
{
  public string $name = 'ProcessEventProducedQueueConsumerWorker';

  public function __construct(
    protected ContainerInterface $container,
    private Consumer $consumer,
    private ProcessEventProcessedConsumerMessage $consumerMessage
  ) {
    parent::__construct($container);
  }

  public function handle(): never
  {
    while (true) {
      $this->consumer->consume($this->consumerMessage);
    }
  }
}
