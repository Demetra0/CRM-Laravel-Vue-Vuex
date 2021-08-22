<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\ManagerStoryController;
use App\Http\Controllers\Api\v1\Google2FAController;
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

// Контроллер для авторизации
Route::group([
        'prefix' => 'auth',
        'namespace' => 'Api',
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('checkToken', [AuthController::class, 'checkToken']);
});

// Ресурсный контроллер для работы с профилями из истории менеджера
Route::resource('manage-story', ManagerStoryController::class)->only([
    'index', 'store', 'show', 'update'
]);


// Ресурсный контроллер для работы с таблицей всех профилей
Route::resource('profile', ProfileController::class)->only([
    'index', 'store', 'show', 'update'
]);;

Route::group([
    'namespace' => 'Api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('enable2fa', [Google2FAController::class, 'enable2fa'])->middleware(['2fa']);
});


