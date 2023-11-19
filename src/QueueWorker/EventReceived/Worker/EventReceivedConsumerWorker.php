<?php declare(strict_types=1);

namespace Manager\QueueWorker\EventReceived\Worker;

use Hyperf\Amqp\Consumer;
use Hyperf\Process\AbstractProcess;
use Manager\QueueWorker\EventReceived\Queue\EventReceivedConsumerMessage;
use Psr\Container\ContainerInterface;

final class EventReceivedConsumerWorker extends AbstractProcess
{
  public function __construct(
    protected ContainerInterface $container,
    private Consumer $consumer,
    private EventReceivedConsumerMessage $eventReceivedConsumerMessage
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
