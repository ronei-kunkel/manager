<?php declare(strict_types=1);

namespace App\Domain\Entity\Event\Type;

use App\Domain\Entity\Event\Type;
use App\Domain\Entity\Event\Type\Push\Commits;
use App\Domain\Entity\Event\Type\Push\Commits\Commit;
use App\Domain\Entity\Event\Type\Push\Repository;
use App\Domain\Entity\Event\Type\Push\Merger;

final class Push extends Type
{
  private Repository $repository;

  private Merger $merger;

  /** @var Commit[] $commits collection of commit */
  private Commits $commits;

  private string $targetBranchReference;
}