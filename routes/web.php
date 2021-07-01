<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('clubs',ClubsController::class);
Route::resource('admin',AdminController::class);
Route::resource('question',QuestionController::class);
Route::get('/dashboard',function(){
    return view('dashboard');
})->name('dashboard');
