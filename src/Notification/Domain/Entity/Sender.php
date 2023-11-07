<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Entity;

final class Sender
{
  public function __construct(
    private int $remoteId,
    private string $nickName,
    private string $email,
    private string $image,
  ) {
  }

  public function remoteId(): ?int
  {
    return $this->remoteId;
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