<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Application\Builder\OwnerBuilder;
use Manager\Shared\Domain\Entity\Repository\Repository;
use Manager\Shared\Domain\ValueObject\Platform;

final class RepositoryBuilder
{
  private Platform $platform;

  private array $data;

  public function __construct(
    private OwnerBuilder $ownerBuilder
  ) {
  }

  public function setPlatform(Platform $platform): self
  {
    $this->platform = $platform;
    return $this;
  }

  public function setData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): Repository
  {
    $owner = $this->ownerBuilder->setData($this->data['owner'])->build();

    return new Repository(
      null,
      $this->data['id'],
      $this->platform,
      $owner,
      $this->data['name'],
      $this->data['clone_url'],
      $this->data['default_branch'],
      $this->data['description']
    );
  }
}