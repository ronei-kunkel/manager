<?php declare(strict_types=1);

namespace Manager\EventReceived\Domain\Factory;

use Manager\EventReceived\Domain\Entity\Event;

final class EventFactory
{
  public static function make(array $headers, array $body): Event
  {
    $type      = $headers['x-github-event'][0];
    $platform  = explode('-', explode('/', $headers['user-agent'][0])[0])[0];

    return new Event($type, $platform, $body);
  }
}
