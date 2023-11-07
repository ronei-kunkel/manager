<?php declare(strict_types=1);
use Manager\Notification\Application\Factory\GitHubEventInputFactory;
use Manager\Notification\Domain\Entity\Event\Push;
use Manager\Notification\Domain\Type\Reference;
use Manager\Notification\Domain\Entity\Repository;
use Manager\Notification\Domain\Entity\Owner;
use Manager\Notification\Domain\Entity\Sender;
use Manager\Notification\Domain\Type\CommitCollection;
use Manager\Notification\Domain\Entity\Commit;

test('Should create a GitHub Push deployable event', function() {
  $gitHubEventInputFactory = resolve(GitHubEventInputFactory::class);

  $gitHubPushEventInput = $gitHubEventInputFactory->createPushEvent(json_decode(gitHubPushEventDeployableWebhookSentPayload(), true));

  expect($gitHubPushEventInput)->toBeInstanceOf(Push::class);

  expect($gitHubPushEventInput->reference())->toBeInstanceOf(Reference::class);
  expect($gitHubPushEventInput->reference()->targetBranch())->toBe('main');
  expect($gitHubPushEventInput->reference()->initialCommit())->toBe('36df0b6680a7c8ce54789a7636b66266688ac864');
  expect($gitHubPushEventInput->reference()->finalCommit())->toBe('cae90d8e65702aa26963f6070e6ed2c6f4502c78');

  expect($gitHubPushEventInput->repository())->toBeInstanceOf(Repository::class);
  expect($gitHubPushEventInput->repository()->name())->toBe('manager');
  expect($gitHubPushEventInput->repository()->remoteId())->toBe(709702927);

  expect($gitHubPushEventInput->repository()->owner())->toBeInstanceOf(Owner::class);
  expect($gitHubPushEventInput->repository()->owner()->nickName())->toBe('ronei-kunkel');
  expect($gitHubPushEventInput->repository()->owner()->remoteId())->toBe(41250984);

  expect($gitHubPushEventInput->sender())->toBeInstanceOf(Sender::class);
  expect($gitHubPushEventInput->sender()->nickName())->toBe('igencee');

  expect($gitHubPushEventInput->commits())->toBeInstanceOf(CommitCollection::class);
  expect($gitHubPushEventInput->commits()->count())->toBe(2);

  expect($gitHubPushEventInput->commits()->getLast())->toBeInstanceOf(Commit::class);
  expect($gitHubPushEventInput->commits()->getLast()->hash())->toBe('cae90d8e65702aa26963f6070e6ed2c6f4502c78');
  expect($gitHubPushEventInput->commits()->getLast()->commiter()->nickName())->toBe('web-flow');
  expect($gitHubPushEventInput->commits()->getLast()->commiter()->nickName())->not()->toBe($gitHubPushEventInput->commits()->getLast()->author()->nickName());

  expect($gitHubPushEventInput->deployable())->toBeTrue();
});

test('Should create a GitHub Push undeployable event', function () {
  $gitHubEventInputFactory = resolve(GitHubEventInputFactory::class);

  $gitHubPushEventInput = $gitHubEventInputFactory->createPushEvent(json_decode(gitHubPushEventUndeployableWebhookSentPayload(), true));

  expect($gitHubPushEventInput)->toBeInstanceOf(Push::class);

  expect($gitHubPushEventInput->reference())->toBeInstanceOf(Reference::class);
  expect($gitHubPushEventInput->reference()->targetBranch())->toBe('tests');
  expect($gitHubPushEventInput->reference()->initialCommit())->toBe('d8d2d72a53507a8c6e961aae7883f5ec28843eb0');
  expect($gitHubPushEventInput->reference()->finalCommit())->toBe('d4b9e2450b76b73ec5b95bd8f51ded61cc129786');

  expect($gitHubPushEventInput->repository())->toBeInstanceOf(Repository::class);
  expect($gitHubPushEventInput->repository()->name())->toBe('manager');
  expect($gitHubPushEventInput->repository()->remoteId())->toBe(709702927);

  expect($gitHubPushEventInput->repository()->owner())->toBeInstanceOf(Owner::class);
  expect($gitHubPushEventInput->repository()->owner()->nickName())->toBe('ronei-kunkel');
  expect($gitHubPushEventInput->repository()->owner()->remoteId())->toBe(41250984);

  expect($gitHubPushEventInput->sender())->toBeInstanceOf(Sender::class);
  expect($gitHubPushEventInput->sender()->nickName())->toBe('ronei-kunkel');

  expect($gitHubPushEventInput->commits())->toBeInstanceOf(CommitCollection::class);
  expect($gitHubPushEventInput->commits()->count())->toBe(1);

  expect($gitHubPushEventInput->commits()->getLast())->toBeInstanceOf(Commit::class);
  expect($gitHubPushEventInput->commits()->getLast()->hash())->toBe('d4b9e2450b76b73ec5b95bd8f51ded61cc129786');
  expect($gitHubPushEventInput->commits()->getLast()->commiter()->nickName())->toBe('ronei-kunkel');
  expect($gitHubPushEventInput->commits()->getLast()->commiter()->nickName())->toBe($gitHubPushEventInput->commits()->getLast()->author()->nickName());

  expect($gitHubPushEventInput->deployable())->toBeFalse();
});