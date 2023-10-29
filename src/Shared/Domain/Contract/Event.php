<?php declare(strict_types=1);

namespace Manager\Shared\Domain\Contract;

use Manager\Shared\Domain\Entity\Repository\Repository;
use Manager\Shared\Domain\ValueObject\Platform;

interface Event
{
  public function id(): ?int;
  public function hash(): string;
  public function platform(): Platform;
  public function repository(): Repository;
}