<?php

use Manager\Notification\Application\Factory\GitHubPushEventFactory;

return [

  "github" => [
    'push' => GitHubPushEventFactory::class,
  ],

];
