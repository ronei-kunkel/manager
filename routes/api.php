<?php

use Illuminate\Support\Facades\Route;

use Manager\Notification\Infra\Controller\GitHubNotifyController;
use Manager\Notification\Infra\Middleware\GitHubAttachEventTypeOnRequestDataMiddleware;
use Manager\Notification\Infra\Middleware\GitHubSignatureVerifyMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('github')->middleware([
    GitHubSignatureVerifyMiddleware::class,
    GitHubAttachEventTypeOnRequestDataMiddleware::class
])->group(function () {
    Route::post('/notify', GitHubNotifyController::class);
});
