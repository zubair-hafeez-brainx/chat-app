<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('register')->group(function () {
    Route::post('users', [RegisterController::class, 'store']);
});

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('message')->group(function () {
        Route::post('/', [MessageController::class, 'create']);
        Route::post('/chat', [MessageController::class, 'chatMessage']);
        Route::get('/', [MessageController::class, 'index']);
        Route::get('/friends', [MessageController::class, 'myFriends']);
        Route::get('/search/user', [MessageController::class, 'searchUser']);
        Route::get('/users-chat', [MessageController::class, 'usersChat']);
        Route::get('/chat-users', [MessageController::class, 'chatedUsers']);
        Route::get('/group-chat', [MessageController::class, 'groupChat']);
    });
});
