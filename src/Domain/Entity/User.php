<?php declare(strict_types=1);

namespace Manager\Domain\Entity;

interface User
{
  public function id(): int;

  public function nickName(): string;

  public function email(): string;
}