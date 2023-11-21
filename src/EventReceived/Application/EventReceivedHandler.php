<?php declare(strict_types=1);

namespace Manager\EventReceived\Application;

use Hyperf\Amqp\Producer;
use Manager\EventReceived\Domain\Factory\EventFactory;
use Manager\EventReceived\Infra\Queue\Producer\EventReceivedMessage;

final class EventReceivedHandler
{

  public function __construct(
    private Producer $producer,
    private EventReceivedMessage $message
  ) {
  }

  public function handle(EventReceivedInput $input): void
  {
    try {
      $event = EventFactory::make($input->headers, $input->body);

      $this->message->setPayload($event->data());

      $this->producer->produce($this->message, true);
    } catch (\Throwable $th) {
      print_r(PHP_EOL);
      print_r($th->getMessage());
      print_r(PHP_EOL);
    }
  }
}