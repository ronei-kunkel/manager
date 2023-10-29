<?php declare(strict_types=1);

namespace Manager\Shared\Domain\Entity\Commit;

final class Commit
{
  public function __construct(
    private string $hash,
    private string $message,
    private Author $author,
    private Committer $committer,
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

  public function commiter(): Committer
  {
    return $this->committer;
  }

  public function timestamp(): string
  {
    return $this->timestamp;
  }
}