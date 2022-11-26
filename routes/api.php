<?php

use App\Http\Controllers\Api\LineMessageController;
use App\Http\Controllers\Api\UserController;

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


Route::post('/webhook', [LineMessageController::class ,'webhook'])->name('line.webhook');
Route::get('/users', [UserController::class ,'index']);
Route::post('/user', [UserController::class ,'store']);
Route::post('/memberId', [UserController::class, 'getMemberId']);

