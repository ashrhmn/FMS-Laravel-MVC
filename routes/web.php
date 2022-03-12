<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;


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

//pagecontroller
Route::get('/' ,[PageController::class,'index'])->name('index');
Route::get('/login' ,[PageController::class,'login'])->name('login');
Route::get('/register' ,[PageController::class,'registation'])->name('register');
Route::get('/logout' ,[PageController::class,'logout'])->name('logout');

Route::post('/register',[PageController::class,'registersubmit'])->name('register.submit');
Route::post('/login',[PageController::class,'loginsubmit'])->name('login.submit');

//admin user
Route::get('/userlist',[AdminController::class,'userlist'])->name('user.list');
Route::get('/managerlist',[AdminController::class,'managerlist'])->name('manager.list');

Route::get('edit/{id}',[AdminController::class,'editlist']);
Route::post('edit/{id}',[AdminController::class,'update'])->name('update.list');
Route::get('/delete/{id}',[AdminController::class,'deletelist'])->name('delete');

//admin user end



