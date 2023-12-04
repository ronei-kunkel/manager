<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Infra\Service;

use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Producer;

final class PublishMessageService
{

  public function __construct(
    private Producer $producer
  ) {
  }

  public function publish(ProducerMessage $message)
  {
    $this->producer->produce($message);
  }
}