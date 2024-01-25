<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\Authcontroller;
use App\Http\Controllers\user\usercontroller;
use App\Http\Controllers\admin\admincontrolle;
use App\Http\Controllers\Controller;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\checkRole;

use App\Http\Controllers\user;
use Cron\DayOfWeekField;


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
    return view('usersView.userDashboard');
})->middleware('auth');


Route::get('login',[Authcontroller::class,'index'])->name('login');
Route::get('registration',[Authcontroller::class,'registration'])->name('registration');

Route::post('postRegistation',[Authcontroller::class,'postRegister'])->name('registrationPost');   
Route::post('postLogin',[Authcontroller::class,'postLogin'])->name('loginPost');   
Route::get('logout',[Authcontroller::class,'logout'])->name('logout');   


// user routes
Route::middleware(["auth","userRole:0"])->group(function(){
    Route::get('userDashboard',[usercontroller::class,'userDashboard'])->name('userDashboard');

    // images
    Route::get('userUploadImage',[usercontroller::class,'userUploadImage'])->name('userUploadImage');
    Route::post('userUploadImagePost',[usercontroller::class,'userUploadImagePost'])->name('userUploadImagePost');
    Route::get('viewMyImages',[usercontroller::class,'viewMyImages'])->name('viewMyImages');
    Route::get('downloadImage/{path}',[usercontroller::class,'downloadImage'])->name('downloadImage');
    Route::get('deleteImage/{id}',[usercontroller::class,'deleteImage'])->name('deleteImage');

    

    

    
    Route::post('editUserByUser',[usercontroller::class,'editUserByUser'])->name('editUserByUser');
    Route::get('editUserByUserView',[usercontroller::class,'editUserByUserView'])->name('editUserByUserView');

    

    
});

Route::middleware(["auth","userRole:1"])->group(function(){
    Route::get('adminDashboard',[admincontrolle::class,'adminDashboard'])->name('adminDashboard');
    Route::get('adminUploadImage',[admincontrolle::class,'adminUploadImage'])->name('adminUploadImage');
    Route::post('adminUploadImagePost',[admincontrolle::class,'adminUploadImagePost'])->name('adminUploadImagePost');
    Route::get('adminViewAllUsers',[admincontrolle::class,'adminViewAllUsersGet'])->name('adminViewAllUsers');

    Route::get('editUserByAdmin/{id}',[admincontrolle::class,'editUserByAdmin'])->name('editUserByAdmin');
    Route::post('editUserByAdminPost',[admincontrolle::class,'editUserByAdminPost'])->name('editUserByAdminPost');

    Route::get('deleteUserByAdmin/{id}',[admincontrolle::class,'deleteUserByAdmin'])->name('deleteUserByAdmin');
    
});

// Route::get('cancelButton',[Controller::class,'cancelButton'])->name('cancelButton');







