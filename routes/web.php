<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\UserController;

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



Route::get('/user/viewprofile',[UserController::class,'viewProfile'])->name('user.viewProfile');
Route::get('/user/editprofile',[UserController::class,'editProfile'])->name('user.editProfile');
Route::post('/user/editprofile',[UserController::class,'editProfileSubmit'])->name('user.editProfileSubmit');
Route::get('/user/index',[UserController::class,'index'])->name('index');
Route::get('/user/flights',[UserController::class,'flights'])->name('user.flights');
Route::post('/user/flights',[UserController::class,'flightsSearch'])->name('user.flightsSearch');
Route::get('/user/changepass',[UserController::class,'changepass'])->name('user.changepass');
Route::post('/user/changepass',[UserController::class,'changepassSubmit'])->name('user.changepassSubmit');
Route::post('/user/ticketbooking',[UserController::class,'bookTicket'])->name('user.bookTicket');
//Route::post('/user/index',[UserController::class,'index'])->name('indexfs');

//page route end

//Manager route Start
Route::get('/manager',[ManagerController::class,'home'])->name('manager.home');
Route::get('/manager/profile',[ManagerController::class,'profile'])->name('manager.profile');
Route::get('/manager/editProfile/{id}',[ManagerController::class,'editProfile'])->name('manager.editProfile');
Route::get('/manager/changepass/{id}',[ManagerController::class,'changepass'])->name('manager.changepass');
Route::get('/manager/userlist',[ManagerController::class,'userlist'])->name('manager.userlist');
Route::get('/manager/userdetails/{id}',[ManagerController::class,'userdetails'])->name('manager.userdetails');
Route::get('/manager/flightdetails/{id}',[ManagerController::class,'flightdetails'])->name('manager.flightdetails');

Route::post('/manager/editProfile',[ManagerController::class,'editProfileSubmit'])->name('manager.editProfileSubmit');
Route::post('/manager/changepass',[ManagerController::class,'changepassSubmit'])->name('manager.changepassSubmit');
Route::post('/manager/userlist',[ManagerController::class,'userlistSearch'])->name('manager.userlistSearch');


//Manager route End 


















