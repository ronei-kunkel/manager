<?php declare(strict_types=1);

namespace Manager\Shared\Domain\ValueObject;

final class Merger
{
  public function __construct(
    private string $name,
    private string $email,
    private string $nickName
  ) {
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