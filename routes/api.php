<?php

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

Route::get('/','\App\Http\Controllers\Api\WelcomeController@index')->name('welcome.api');
Route::post('/register','\App\Http\Controllers\Api\Auth\IndexController@register')->name('register.api');
Route::post('/login','\App\Http\Controllers\Api\Auth\IndexController@login')->name('login.api');

Route::group(['middleware' => ['auth.parse.user']], function () {
    Route::get('students', [\App\Http\Controllers\Api\StudentsController::class, 'index']);
    Route::post('students', [\App\Http\Controllers\Api\StudentsController::class, 'create']);
    Route::get('students/{student}', [\App\Http\Controllers\Api\StudentsController::class, 'show']);
    Route::put('students/{student}', [\App\Http\Controllers\Api\StudentsController::class, 'update']);
    Route::delete('students/{student}', [\App\Http\Controllers\Api\StudentsController::class, 'destroy']);
});

