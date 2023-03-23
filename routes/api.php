<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskOfUserController;

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
Route::resource('users', UserController::class)->only([
    'index', 'show', 'store'
]);
Route::resource('tasks', TaskController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);
Route::group(['middleware' => 'uuid'], function () {
    Route::put('users/{id}', 'App\Http\Controllers\UserController@update');
    Route::get('user/tasks', 'App\Http\Controllers\TaskController@getListTaskOfUser');
    Route::get('user/{id}/tasks', 'App\Http\Controllers\TaskController@getListTaskByUser');
});
