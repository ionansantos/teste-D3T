<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;


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
// Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('schedule', [ScheduleController::class, 'index']);
Route::post('schedule/create', [ScheduleController::class, 'store'])->name('store');
Route::get('schedule/get/{id}', [ScheduleController::class, 'show']);
Route::post('schedule/update/{id}', [ScheduleController::class, 'update']);
Route::delete('schedule/delete/{id}', [ScheduleController::class, 'destroy']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
