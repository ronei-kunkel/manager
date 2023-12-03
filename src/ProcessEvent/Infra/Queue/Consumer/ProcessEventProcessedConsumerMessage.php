<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Infra\Queue\Consumer;

use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;

final class ProcessEventProcessedConsumerMessage extends ConsumerMessage
{
  protected array|string $routingKey = 'event-processed';
  protected ?string $queue = 'event-processed';
  protected string $exchange = 'manager';

  public function __construct(
  ) {
  }

  public function consume($data): string
  {
    // print_r($data);
    return Result::ACK;
  }
}
