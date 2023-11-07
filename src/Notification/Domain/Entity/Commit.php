<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Entity;

use Manager\Notification\Domain\Type\Author;
use Manager\Notification\Domain\Type\Committer;
use Manager\Notification\Domain\Type\Platform;

final class Commit
{
  private bool $fromMerge;

  public function __construct(
    private string $hash,
    private string $message,
    private Author $author,
    private Committer $committer,
    private Platform $platform,
    private string $timestamp
  ) {
    $this->checkIsMerge();
  }

  private function checkIsMerge(): void
  {
    $this->fromMerge = match ($this->platform->hash()) {
      'github' => ($this->commiter()->nickName() === 'web-flow'),
    };
  }

  public function isMerge(): bool
  {
    return $this->fromMerge;
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

  public function platform(): Platform
  {
    return $this->platform;
  }

  public function timestamp(): string
  {
    return $this->timestamp;
  }
}