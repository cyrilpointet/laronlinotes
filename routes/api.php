<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', [UserController::class, 'show']);
    Route::post('/note', [NoteController::class, 'create']);
    Route::put('/note/{id}', [NoteController::class, 'update']);
    Route::delete('/note/{id}', [NoteController::class, 'delete']);
});
