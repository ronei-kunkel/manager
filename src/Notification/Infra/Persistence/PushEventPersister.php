<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Persistence;

use DB;
use Manager\Notification\Domain\Entity\Event\Push;

final class PushEventPersister
{
  public function persist(Push $push): ?int
  {
    return DB::transaction(function () use ($push) {

      $ownerId = DB::table('user')
        ->where('nickname', $push->repository()->owner()->nickName())
        ->select('id')
        ->first();

      if (!$ownerId) {
        $ownerId = DB::table('user')->insertGetId([
          'name'      => '-',
          'email'     => $push->repository()->owner()->email(),
          'nickname'  => $push->repository()->owner()->nickName(),
          'image_url' => $push->repository()->owner()->image()
        ]);
      }

      $ownerId = ($ownerId instanceof \stdClass) ? $ownerId->id : $ownerId;

      $platformHash = DB::table('platform')
        ->where('hash', $push->repository()->platform()->hash())
        ->select('hash')
        ->first();

      if (!$platformHash) {
        DB::table('platform')->insert([
          'hash' => $push->repository()->platform()->hash(),
          'name' => $push->repository()->platform()->name(),
          'url'  => $push->repository()->platform()->url()
        ]);
      }

      $repositoryId = DB::table('repository')
      ->where('remote_id', $push->repository()->remoteId())
      ->where('platform_hash', $push->platform()->hash())
      ->where('name', $push->repository()->name())
      ->select('id')
      ->first();

      if (!$repositoryId) {
        $repositoryId = DB::table('repository')->insertGetId([
          'remote_id' => $push->repository()->remoteId(),
          'platform_hash' => $push->platform()->hash(),
          'owner_id' => $ownerId,
          'name' => $push->repository()->name(),
          'clone_url' => $push->repository()->cloneUrl(),
          'default_branch' => $push->repository()->defaultBranch(),
          'description' => $push->repository()->description()
        ]);
      }

      $repositoryId = ($repositoryId instanceof \stdClass) ? $repositoryId->id : $repositoryId;

      $eventId = DB::table('event')->insertGetId([
        'hash'          => 'push',
        'platform_hash' => $push->platform()->hash()
      ]);

      $senderId = DB::table('user')
      ->where('nickname', $push->sender()->nickName())
      ->select('id')
      ->first();

      if (!$senderId) {
        $senderId = DB::table('user')->insertGetId([
          'name'      => '-',
          'email'     => $push->sender()->email(),
          'nickname'  => $push->sender()->nickName(),
          'image_url' => $push->sender()->image()
        ]);
      }

      $senderId = ($senderId instanceof \stdClass) ? $senderId->id : $senderId;


      return DB::table('event_push')->insert([
        'event_id' => $eventId,
        'platform_hash' => $push->platform()->hash(),
        'repository_id'  => $repositoryId,
        'sender_id' => $senderId,
        'deployable' => (int) $push->deployable(),
        'target_branch' => $push->reference()->targetBranch()
      ]) ? $eventId : null;
    });
  }
}