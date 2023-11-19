<?php

declare(strict_types=1);

namespace Manager\EventReceived\Infra\Queue;

use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Message\Type;

class EventReceivedMessage extends ProducerMessage
{
    protected string $exchange = 'manager';
    protected string $type = Type::TOPIC;
    protected array|string $routingKey = 'event.received';
}
