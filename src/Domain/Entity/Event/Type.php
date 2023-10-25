<?php declare(strict_types=1);

namespace App\Domain\Entity\Event;

abstract class Type
{
  private string $hash;

  public function hash(): string
  {
    return $this->hash;
  }
}