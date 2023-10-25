<?php declare(strict_types=1);

namespace App\Domain\Entity\Event\Type\Push;

final class Merger
{
  public function __construct(
    private string $id,
    private string $user,
    private string $image
  ) {
  }
}