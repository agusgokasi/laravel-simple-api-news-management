<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\CommentController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware(['isAdmin'])->group(function () {
        Route::post('/news/post', [NewsController::class, 'store']);
        Route::put('/news/{id}', [NewsController::class, 'update']);
        Route::delete('/news/{id}', [NewsController::class, 'destroy']);
    });

    Route::middleware(['isNotAdmin'])->group(function () {
        Route::post('/news/{news}/comment', [CommentController::class, 'store']);
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
