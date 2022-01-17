<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/', [HomeController::class, 'index']);
    Route::post('/add_music', [HomeController::class, 'store']);
    Route::get('/delete_music/{id}', [HomeController::class, 'destroy']);
});
