<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Domain\Entity\Repository\Owner;
use Manager\Shared\Domain\Entity\Repository\Repository;
use Manager\Shared\Domain\ValueObject\Platform;

final class OwnerBuilder
{
  private array $data;

  public function setData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): Owner
  {
    return new Owner(
      $this->data['id'],
      $this->data['login'],
      $this->data['email'],
      $this->data['avatar_url']
    );
  }
}