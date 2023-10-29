<?php declare(strict_types=1);

namespace Manager\Shared\Domain\Entity\Commit;

use Manager\Shared\Domain\Contract\User;

final class Author implements User
{
  public function __construct(
    private ?int $id,
    private string $nickName,
    private string $email
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
}