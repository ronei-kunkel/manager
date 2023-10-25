<?php declare(strict_types=1);

namespace App\Domain\Entity\Event;

abstract class Platform
{
  public function __construct(
    private string $hash,
    private string $name,
    private string $url,
  ) {
  }
}