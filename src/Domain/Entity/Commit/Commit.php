<?php declare(strict_types=1);

namespace Manager\Domain\Entity\Commit;

final class Commit
{
  public function __construct(
    private string $hash,
    private string $message,
    private Author $author,
    private Commiter $commiter,
    private string $timestamp
  ) {
  }

  public function hash(): string
  {
    return $this->hash;
  }

  public function message(): string
  {
      return $this->message;
  }

  public function author(): Author
  {
    return $this->author;
  }

  public function commiter(): Commiter
  {
    return $this->commiter;
  }

  public function timestamp(): string
  {
    return $this->timestamp;
  }
}