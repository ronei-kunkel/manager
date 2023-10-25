<?php declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Entity\Event\Type;
use App\Domain\Entity\Event\Platform;

final class Event
{
  public function __construct(
    private int $id,
    private Platform $platform,
    private Type $type
  ) {
  }
}