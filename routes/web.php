<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\Authcontroller;
use App\Http\Controllers\user\usercontroller;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Editor\EditorController;
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

Route::get('googleSearch', function () {
    return redirect()->away('https://photofocus.com/');
})->name('googleSearch');


Route::view('login', 'auth.login')->name('login');
Route::view('registration', 'auth.registration')->name('registration');
Route::view('forgotPassword', 'auth.forgotPassword')->name('forgotPassword');
Route::post('forgotPasswordPost', [Authcontroller::class, 'forgotPasswordPost'])->name('forgotPasswordPost');
Route::get('resetPasswordForm/{email}/{token}', [Authcontroller::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('resetPasswordPost', [Authcontroller::class, 'resetPasswordPost'])->name('resetPasswordPost');
Route::post('postRegistation', [Authcontroller::class, 'postRegister'])->name('registrationPost');
Route::post('postLogin', [Authcontroller::class, 'postLogin'])->name('loginPost');
Route::get('logout', [Authcontroller::class, 'logout'])->name('logout');


// user routes
Route::middleware(["auth", "userRole:1"])->group(function () {
    Route::get('userDashboard', [usercontroller::class, 'userDashboard'])->name('userDashboard');

    // images
    Route::get('userUploadImage', [usercontroller::class, 'userUploadImage'])->name('userUploadImage');
    Route::post('userUploadImagePost', [usercontroller::class, 'userUploadImagePost'])->name('userUploadImagePost');
    Route::get('viewMyImages', [usercontroller::class, 'viewMyImages'])->name('viewMyImages');
    Route::get('downloadImage/{path}', [usercontroller::class, 'downloadImage'])->name('downloadImage');
    Route::get('deleteImage/{id}', [usercontroller::class, 'deleteImage'])->name('deleteImage');


    Route::post('editUserByUser', [usercontroller::class, 'editUserByUser'])->name('editUserByUser');
    Route::get('editUserByUserView', [usercontroller::class, 'editUserByUserView'])->name('editUserByUserView');
});


Route::middleware(["auth", "userRole:2"])->group(function () {
    Route::get('editorDashboard', [EditorController::class, 'editorDashboard'])->name('EditorDashboard');
});


// middlware for all admin routes is applied over the AdminController class
Route::middleware(["auth", 'userRole:3'])->group(function () {
    Route::get('adminDashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('adminUploadImage', [AdminController::class, 'adminUploadImage'])->name('adminUploadImage');
    Route::post('adminUploadImagePost', [AdminController::class, 'adminUploadImagePost'])->name('adminUploadImagePost');
    Route::get('adminViewAllUsers', [AdminController::class, 'adminViewAllUsersGet'])->name('adminViewAllUsers');

    Route::get('editUserByAdmin/{id}', [AdminController::class, 'editUserByAdmin'])->name('editUserByAdmin');
    Route::post('editUserByAdminPost', [AdminController::class, 'editUserByAdminPost'])->name('editUserByAdminPost');

    // update role of the user
    Route::post('updateRole', [AdminController::class, 'updateRole'])->name('updateRole');

    // delete user by admin
    Route::get('deleteUserByAdmin/{id}', [AdminController::class, 'deleteUserByAdmin'])->name('deleteUserByAdmin');

    // send all users data into mail
    Route::post('mailAllUserDataPost', [AdminController::class, 'mailAllUserDataPost'])->name('mailAllUserDataPost');
});
