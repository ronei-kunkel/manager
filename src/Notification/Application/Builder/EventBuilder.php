<?php declare(strict_types=1);

namespace Manager\Notification\Application\Builder;

use Manager\Notification\Domain\Entity\Event\GitHub\Push;
use Manager\Shared\Domain\Collection\CommitCollection;
use Manager\Shared\Domain\Contract\Event;
use Manager\Shared\Domain\Entity\Commit\Author;
use Manager\Shared\Domain\Entity\Commit\Commit;
use Manager\Shared\Domain\Entity\Commit\Committer;
use Manager\Shared\Domain\Entity\Repository\Owner;
use Manager\Shared\Domain\Entity\Repository\Repository;
use Manager\Shared\Domain\ValueObject\Merger;
use Manager\Shared\Domain\ValueObject\Platform;

final class EventBuilder
{
  private Platform $platform;

  private array $notificationData;

  private Event $event;

  public function __construct(
    // private GitHubApiService $gitHubApiService
  ){
  }

  public function fromGitLab(array $notificationData): self
  {
    $this->platform = new Platform('gitlab', 'GitLab', 'https://gitlab.com');
    $this->notificationData = $notificationData;
    return $this;
  }

  public function fromGitHub(array $notificationData): self
  {
    $this->platform = new Platform('github', 'GitHub', 'https://github.com');
    $this->notificationData = $notificationData;
    return $this;
  }

  public function defineGitHubPushEvent(): self
  {
    $this->event = new Push(null,
      $this->platform,
      $this->buildGitHubRepository(),
      $this->buildGitHubMerger(),
      $this->buildGitHubCommits(),
      $this->notificationData['ref']
    );

    return $this;
  }

  public function build(): Event
  {
    // throw exception if event is not set
    return $this->event;
  }

  private function buildOwner(): Owner
  {
    return new Owner(
      $this->notificationData['repository']['owner']['id'],
      $this->notificationData['repository']['owner']['login'],
      $this->notificationData['repository']['owner']['email'],
      $this->notificationData['repository']['owner']['avatar_url']
    );
  }

  private function buildGitHubRepository(): Repository
  {
    return new Repository(
      null,
      $this->notificationData['repository']['id'],
      $this->platform,
      $this->buildOwner(),
      $this->notificationData['repository']['name'],
      $this->notificationData['repository']['clone_url'],
      $this->notificationData['repository']['default_branch'],
      $this->notificationData['repository']['description']
    );
  }

  private function buildGitHubMerger(): Merger
  {
    return new Merger(
      $this->notificationData['head_commit']['committer']['name'],
      $this->notificationData['head_commit']['committer']['email'],
      $this->notificationData['head_commit']['committer']['username'],
    );
  }

  private function buildGitHubCommits(): CommitCollection
  {
    // $commits = $this->gitHubApiService->getCommits($this->notificationData['before'], $this->notificationData['after']);
    $commits = new CommitCollection(count($this->notificationData['commits']));

    foreach ($this->notificationData['commits'] as $key => $commit) {

      $author = new Author(
        null,
        $commit['author']['username'],
        $commit['author']['email']
      );

      $committer = new Committer(
        null,
        $commit['committer']['username'],
        $commit['committer']['email']
      );

      $commit = new Commit(
        $commit['id'],
        $commit['message'],
        $author,
        $committer,
        $commit['timestamp']
      );

      $commits->add($key, $commit);
    }

    return $commits;
  }
}
