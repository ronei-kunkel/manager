<?php declare(strict_types=1);

namespace Manager\Shared\Domain\Entity\Repository;

use Manager\Shared\Domain\Contract\User;

final class Owner implements User
{
  public function __construct(
    private ?int $id,
    private string $nickName,
    private string $email,
    private string $image,
  ) {
  }

  public function id(): ?int
  {
    return $this->id;
  }

  public function nickName(): string
  {
    return $this->nickName;
  }

  public function email(): string
  {
    return $this->email;
  }

  public function image(): string
  {
    return $this->image;
  }
}