<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authcontroller;
use App\Http\Middleware\Authenticate;
// use App\Http\Controllers\Auth


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('login',[Authcontroller::class,'index'])->name('login');
Route::get('registration',[Authcontroller::class,'registration'])->name('registration');

Route::post('post-Registation',[Authcontroller::class,'postRegister'])->name('registration.post');   
Route::post('post-Login',[Authcontroller::class,'postLogin'])->name('login.post');   
Route::post('logout',[Authcontroller::class,'logout'])->name('logout');   



