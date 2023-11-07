<?php declare(strict_types=1);

namespace Manager\Notification\Application\Factory;

use Manager\Notification\Domain\Builder\PushEventBuilder;
use Manager\Notification\Domain\Entity\Commit;
use Manager\Notification\Domain\Entity\Event\Push;
use Manager\Notification\Domain\Entity\Owner;
use Manager\Notification\Domain\Entity\Repository;
use Manager\Notification\Domain\Entity\Sender;
use Manager\Notification\Domain\Type\Author;
use Manager\Notification\Domain\Type\CommitCollection;
use Manager\Notification\Domain\Type\Committer;
use Manager\Notification\Domain\Type\Platform;
use Manager\Notification\Domain\Type\Reference;

final class GitHubEventInputFactory
{
  private array $inputData;

  private Platform $platform;

  private Reference $reference;

  private Repository $repository;

  private Sender $sender;

  private CommitCollection $commits;

  public function __construct(
    private PushEventBuilder $pushEventBuilder,
  ) {
  }

  public function createPushEvent(array $data): Push
  {
    $this->inputData = $data;

    $this->createPlatform()
      ->createReference()
      ->createRepository()
      ->createSender()
      ->createCommits();

    return $this->pushEventBuilder
      ->fromPlatform($this->platform)
      ->withReference($this->reference)
      ->withRepository($this->repository)
      ->withSender($this->sender)
      ->withCommits($this->commits)
      ->build();
  }

  private function createPlatform(): self
  {
    $this->platform = new Platform(
      'github',
      'GitHub',
      'https://github.com'
    );
    return $this;
  }

  private function createReference(): self
  {
    $this->reference = new Reference(
      $this->inputData['ref'],
      $this->inputData['before'],
      $this->inputData['after'],
    );
    return $this;
  }

  private function createRepository(): self
  {
    if (!$this->platform) {
      throw new \Exception('Internal Error: Create Platform before create Repository is required');
    }

    $owner = new Owner(
      $this->inputData['repository']['owner']['id'],
      $this->inputData['repository']['owner']['login'],
      $this->inputData['repository']['owner']['email'],
      $this->inputData['repository']['owner']['avatar_url']
    );

    $this->repository = new Repository(
      $this->inputData['repository']['id'],
      $this->platform,
      $owner,
      $this->inputData['repository']['name'],
      $this->inputData['repository']['clone_url'],
      $this->inputData['repository']['default_branch'],
      $this->inputData['repository']['description']
    );
    return $this;
  }

  private function createSender(): self
  {
    $email = $this->inputData['sender']['email'] ?? $this->inputData['sender']['id'] . '+' . $this->inputData['sender']['login'] . '@users.noreply.github.com';

    $this->sender = new Sender(
      $this->inputData['sender']['id'],
      $this->inputData['sender']['login'],
      $email,
      $this->inputData['sender']['avatar_url'],
    );
    return $this;
  }

  private function createCommits(): self
  {
    $this->commits = new CommitCollection(count($this->inputData['commits']));

    foreach ($this->inputData['commits'] as $key => $commit) {

      $commit = $this->createCommit($commit);

      $this->commits->add($key, $commit);
    }

    return $this;
  }

  private function createCommit(array $commit): Commit
  {
    $author = new Author(
      $commit['author']['username'],
      $commit['author']['email']
    );

    $committer = new Committer(
      $commit['committer']['username'],
      $commit['committer']['email']
    );

    return new Commit(
      $commit['id'],
      $commit['message'],
      $author,
      $committer,
      $this->platform,
      $commit['timestamp']
    );
  }
}