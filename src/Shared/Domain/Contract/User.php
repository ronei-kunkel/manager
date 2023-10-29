<?php declare(strict_types=1);

namespace Manager\Shared\Domain\Contract;

interface User
{
  public function id(): ?int;

  public function nickName(): string;

  public function email(): string;
}