<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Type;

final class Author
{
  public function __construct(
    private string $nickName,
    private string $email
  ) {
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