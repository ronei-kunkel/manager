<?php

use Illuminate\Support\Facades\Route;

use Manager\Notification\Infra\Controller\GitHubPushEventController;
use Manager\Notification\Infra\Middleware\GitHubSignatureVerify;

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
    GitHubSignatureVerify::class,
])->group(function () {
    Route::post('/push', GitHubPushEventController::class);
});
