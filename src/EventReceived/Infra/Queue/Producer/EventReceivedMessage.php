<?php

declare(strict_types=1);

namespace Manager\EventReceived\Infra\Queue\Producer;

use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Message\Type;

class EventReceivedMessage extends ProducerMessage
{
    protected string $exchange = 'manager';
    protected string $type = Type::DIRECT;
    protected array|string $routingKey = 'event-received';
}
