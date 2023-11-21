<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Provider;

use Manager\ProcessEvent\Application\UseCase\Ping\PingEventFactory;
use Manager\ProcessEvent\Domain\Base\Event;

use function Hyperf\Support\make;

final class EventProvider
{
  private static function systemMakeEvent(string $className, array $data): Event
  {
    $factory = make($className);
    return $factory->make($data['type'], $data['platform'], $data['content']);
  }

  public static function make(string $type, string $platform, array $content): Event
  {
    $data = [
      'type'     => $type,
      'platform' => $platform,
      'content'  => $content
    ];

    switch ($type) {
      case 'ping':
        return self::systemMakeEvent(PingEventFactory::class, $data);

      default:
        throw new \Exception('Event Not suported');
    }
  }
}
