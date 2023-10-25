<?php declare(strict_types=1);

namespace App\Domain\Entity\Event\Type\Push\Repository;

final class Owner
{

  public function __construct(
    private string $id,
    private string $user,
    private string $email,
    private string $image
  ) {
  }

}