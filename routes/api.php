<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\UserController;
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
    Route::get('user', [LoginController::class, 'currentUser']);
    Route::get('user/search', [UserController::class, 'searchUsers']);

    Route::prefix('message')->group(function () {
        Route::post('/', [MessageController::class, 'create']);
        Route::get('/friends', [MessageController::class, 'friendUsers']);
        Route::get('/user-chat', [MessageController::class, 'usersChat']);
        Route::get('/search/user', [MessageController::class, 'searchUser']);
        Route::get('/chat-users', [MessageController::class, 'chatedUsers']);
        Route::get('/group-chat', [MessageController::class, 'groupChat']);
    });
});
