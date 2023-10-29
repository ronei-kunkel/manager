<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Entity;

use Manager\Shared\Domain\Contract\Event;
use Manager\Shared\Domain\Entity\Repository\Repository;
use Manager\Shared\Domain\ValueObject\Platform;

final class Notification
{
  public function __construct(
    private ?int $id,
    private Event $event,
    private Platform $platform,
    private Repository $repository
  ){
  }

  public function id(): ?int
  {
    return $this->id;
  }

  public function event(): Event
  {
    return $this->event;
  }

  public function platform(): Platform
  {
    return $this->platform;
  }

  public function repository(): Repository
  {
    return $this->repository;
  }
}