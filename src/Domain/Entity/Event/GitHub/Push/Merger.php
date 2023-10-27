<?php declare(strict_types=1);

namespace Manager\Domain\Entity\Event\GitHub\Push;

use Manager\Domain\Entity\User;

final class Merger implements User
{
  public function __construct(
    private int $id,
    private string $name,
    private string $email,
    private string $nickName
  ) {
  }

  public function id(): int
  {
    return $this->id;
  }

  public function name(): string
  {
    return $this->name;
  }

  public function email(): string
  {
    return $this->email;
  }

  public function nickName(): string
  {
    return $this->nickName;
  }
}