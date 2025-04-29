<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload_file', [App\Http\Controllers\ApiLinksController::class, 'store'])->name('store');

Route::post('/get_file', [App\Http\Controllers\ApiLinksController::class, 'index'])->name('index');

Route::fallback(function () {
    return Response::json(["error" => "Unauthorize access"], 404);
});
