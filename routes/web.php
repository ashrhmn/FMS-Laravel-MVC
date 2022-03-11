<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ManagerController;


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
//page route start
Route::get('/' ,[PageController::class,'index'])->name('index');
Route::get('/login' ,[PageController::class,'login'])->name('login');
Route::get('/register' ,[PageController::class,'registation'])->name('register');
Route::get('/logout' ,[PageController::class,'logout'])->name('logout');

Route::post('/register',[PageController::class,'registersubmit'])->name('register.submit');

Route::post('/login',[PageController::class,'loginsubmit'])->name('login.submit');

//page route end

//Manager route Start
Route::get('/manager',[ManagerController::class,'home'])->name('manager.home');
Route::get('/manager/profile',[ManagerController::class,'profile'])->name('manager.profile');
Route::get('/manager/editProfile/{id?}',[ManagerController::class,'editProfile'])->name('manager.editProfile');

Route::post('/manager/editProfile',[ManagerController::class,'editProfileSubmit'])->name('manager.editProfileSubmit');

//Manager route End




















