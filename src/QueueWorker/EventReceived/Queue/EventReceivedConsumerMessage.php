<?php declare(strict_types=1);

namespace Manager\QueueWorker\EventReceived\Queue;

use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;

final class EventReceivedConsumerMessage extends ConsumerMessage
{
  protected array|string $routingKey = 'event.received';
  protected ?string $queue = 'event-received';
  protected string $exchange = 'manager';

  public function __construct(
  ) {
  }

  public function consume($data): string
  {
    // sleep(5);
    print_r($data['type']);
    return Result::ACK;
  }
}