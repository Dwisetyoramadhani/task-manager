<?php

use App\Http\Controllers\AuthControlller;
use App\Http\Controllers\LabelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/auth/register', [AuthControlller::class, 'register']);
Route::post('/auth/login',[AuthControlller::class, 'login']);
Route::post('/auth/logout', [AuthControlller::class, 'logout'])->middleware('auth:sanctum');


Route::apiResource('/labels', LabelController::class)->middleware('auth:sanctum');
