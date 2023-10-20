<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// 新規登録時にusersテーブルに情報を保存するためのルート
Route::post('/register', [UserController::class, 'register']);
// 投稿時にpostsテーブルに情報を保存するためのルート
Route::post('/posts', [PostController::class, 'store']);
// 全ての投稿内容を取得・表示するためのルート
Route::get('/all-posts', [PostController::class, 'getAllPosts']);
// 投稿にいいねするためのルート
Route::post('/like', [LikeController::class, 'store']);
// 投稿のいいねを解除するためのルート
Route::delete('/unlike', [LikeController::class, 'destroy']);