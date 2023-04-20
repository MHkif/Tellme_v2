<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\PodcastController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\RoomController;

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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('podcasts', PodcastController::class);
    Route::post('podcast/store', [PodcastController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('checkToken', [AuthController::class, 'checkToken']);
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('podcasts', [PodcastController::class, 'index']);
    Route::post('search', [UserController::class, 'search']);
    Route::post('calling', [NotificationController::class, 'notifyUser']);
    Route::post('callUser', [RoomController::class, 'callUser']);

    Route::post('unreadNotification', [NotificationController::class, 'notifications']);

    // Profile
    Route::post('mypodcasts', [UserController::class, 'mypodcasts']);
    Route::post('myPlayLists', [UserController::class, 'myPlayLists']);
});
