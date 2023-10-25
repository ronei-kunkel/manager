<?php declare(strict_types=1);

namespace App\Domain\Entity\Event\Type\Push;

use App\Domain\Entity\Event\Type\Push\Repository\Owner;

final class Repository
{

  public function __construct(
    private string $id,
    private string $name,
    private Owner $owner,
    private string $cloneUrl,
    private string $defaultBranch
  ) {
  }
}