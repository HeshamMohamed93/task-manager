<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('tasks/{taskId}/comments', [CommentController::class, 'index']);
    Route::post('tasks/{taskId}/comments', [CommentController::class, 'store']);
    Route::get('tasks/{taskId}/comments/{commentId}', [CommentController::class, 'show']);
    Route::put('tasks/{taskId}/comments/{commentId}', [CommentController::class, 'update']);
    Route::delete('tasks/{taskId}/comments/{commentId}', [CommentController::class, 'destroy']);

    Route::post('logout',[AuthController::class,'logout']);
    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    Route::post('tasks/{id}/assign', [TaskController::class, 'assignUsers']);

});

