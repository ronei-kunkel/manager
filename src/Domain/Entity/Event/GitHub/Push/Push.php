<?php declare(strict_types=1);

namespace Manager\Domain\Entity\Event\GitHub\Push;

use Manager\Domain\Entity\Commit\Commit;
use Manager\Domain\Entity\Commit\CommitCollection;
use Manager\Domain\Entity\Event\Event;
use Manager\Domain\Entity\Platform\Platform;
use Manager\Domain\Entity\Repository\Repository;

final class Push extends Event
{
  private const HASH = 'push';

  public function __construct(
    private Platform $platform,
    private Repository $repository,
    private Merger $merger,
    private CommitCollection $commits,
    private string $targetBranchReference
  ) {
  }

  public function hash(): string
  {
    return self::HASH;
  }

  public function platform(): Platform
  {
    return $this->platform;
  }

  /**
   * @return Commit[]
   */
  public function commits(): CommitCollection
  {
    return $this->commits;
  }

}