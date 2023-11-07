<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Entity;

use Manager\Notification\Domain\Type\Platform;

final class Repository
{
  public function __construct(
    private int $remoteId,
    private Platform $platform,
    private Owner $owner,
    private string $name,
    private string $cloneUrl,
    private string $defaultBranch,
    private string $description
  ) {
  }

  public function remoteId(): int
  {
    return $this->remoteId;
  }

  public function platform(): Platform
  {
    return $this->platform;
  }

  public function owner(): Owner
  {
    return $this->owner;
  }

  public function name(): string
  {
    return $this->name;
  }

  public function cloneUrl(): string
  {
    return $this->cloneUrl;
  }

  public function defaultBranch(): string
  {
    return $this->defaultBranch;
  }

  public function description(): string
  {
    return $this->description;
  }

}