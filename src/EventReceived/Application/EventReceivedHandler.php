<?php declare(strict_types=1);

namespace Manager\EventReceived\Application;

use Hyperf\Amqp\Producer;
use Manager\EventReceived\Domain\Entity\Event;
use Manager\EventReceived\Infra\Queue\EventReceivedMessage;

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
        $eventType = $input->headers['x-github-event'][0];
        $eventPlatform = explode('-', explode('/', $input->headers['user-agent'][0])[0])[0];
        $eventContent = $input->body;

        $event = new Event($eventType, $eventPlatform, $eventContent);

        $this->message->setPayload($event->data());

        $this->producer->produce($this->message, true);
    } catch (\Throwable $th) {
      print_r(PHP_EOL);
      print_r($th->getMessage());
      print_r(PHP_EOL);
    }
  }
}