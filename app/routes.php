<?php

declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;
use App\Infra\Controller\Github\PushNotifiedController;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxyInterface $group) {
        $group->group('/github', function (RouteCollectorProxyInterface $group) {
            $group->post('/push', PushNotifiedController::class);
        });
    });
};
