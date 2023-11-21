<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Infra\Queue\Consumer;

use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;
use Manager\ProcessEvent\Application\ProcessEventHandler;
use Manager\ProcessEvent\Application\ProcessEventInput;

final class ProcessEventConsumerMessage extends ConsumerMessage
{
  protected array|string $routingKey = 'event-received';
  protected ?string $queue = 'event-received';
  protected string $exchange = 'manager';

  public function __construct(
    private ProcessEventHandler $processEventHandler
  ) {
  }

  public function consume($data): string
  {
    try {
      $input = new ProcessEventInput($data['type'], $data['platform'], $data['content']);
      $this->processEventHandler->handle($input); // return output?
      return Result::ACK;
    } catch (\Throwable $th) {
      // in case of error on processment, the data need to be re-enqueued?
      return $th->getMessage();
    }
  }
}
