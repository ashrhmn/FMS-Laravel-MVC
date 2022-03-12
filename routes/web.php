<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightManagerController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ManagerController;
use Illuminate\Http\Request;

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
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'registation'])->name('register');
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::post('/register', [PageController::class, 'registersubmit'])->name('register.submit');
Route::post('/login', [PageController::class, 'loginsubmit'])->name('login.submit');

//admin user
Route::get('/userlist', [AdminController::class, 'userlist'])->name('user.list');
Route::get('/managerlist', [AdminController::class, 'managerlist'])->name('manager.list');

Route::get('edit/{id}', [AdminController::class, 'editlist']);
Route::post('edit/{id}', [AdminController::class, 'update'])->name('update.list');
Route::get('/delete/{id}', [AdminController::class, 'deletelist'])->name('delete');


Route::get('editmanager/{id}', [AdminController::class, 'managereditlist']);
Route::post('editmanager/{id}', [AdminController::class, 'managerupdate'])->name('managerupdate');
Route::get('/managerdelete/{id}', [AdminController::class, 'managerdelete'])->name('managerdelete');

Route::post('/userlist', [AdminController::class, 'searchsubmit'])->name('search.submit');

//admin user end


Route::get('/user/viewprofile', [UserController::class, 'viewProfile'])->name('user.viewProfile');
Route::get('/user/editprofile', [UserController::class, 'editProfile'])->name('user.editProfile');
Route::post('/user/editprofile', [UserController::class, 'editProfileSubmit'])->name('user.editProfileSubmit');
Route::get('/user/index', [UserController::class, 'index'])->name('index');
Route::get('/user/flights', [UserController::class, 'flights'])->name('user.flights');
//Route::post('/user/index',[UserController::class,'index'])->name('indexfs');

//page route end

//Manager route Start
Route::get('/manager', [ManagerController::class, 'home'])->name('manager.home');
Route::get('/manager/profile', [ManagerController::class, 'profile'])->name('manager.profile');
Route::get('/manager/editProfile/{id}', [ManagerController::class, 'editProfile'])->name('manager.editProfile');
Route::get('/manager/changepass/{id}', [ManagerController::class, 'changepass'])->name('manager.changepass');
Route::get('/manager/userlist', [ManagerController::class, 'userlist'])->name('manager.userlist');
Route::get('/manager/userdetails/{id}', [ManagerController::class, 'userdetails'])->name('manager.userdetails');
Route::get('/manager/flightdetails/{id}', [ManagerController::class, 'flightdetails'])->name('manager.flightdetails');
Route::get('/manager/cancelticket/{id}/{uid}', [ManagerController::class, 'cancelticket'])->name('manager.cancelticket');
Route::get('/manager/searchuserlist', [ManagerController::class, 'searchuserlist'])->name('manager.searchuserlist');
Route::post('/manager/editProfile', [ManagerController::class, 'editProfileSubmit'])->name('manager.editProfileSubmit');
Route::post('/manager/changepass', [ManagerController::class, 'changepassSubmit'])->name('manager.changepassSubmit');
Route::post('/manager/userlist', [ManagerController::class, 'userlistSearch'])->name('manager.userlistSearch');
Route::post('/manager/searchuserlist', [ManagerController::class, 'searchuserlistsubmit'])->name('manager.searchuserlistsubmit');


//Manager route End 


// flight manager route start

Route::get('/flight-manager', [FlightManagerController::class, 'dashboard'])->name('fmgr.dashboard');


// flight manager route end

// auth routes start

Route::get('/auth/signin', [AuthController::class, 'signin'])->name('auth.signin');
Route::get('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');

Route::post('/auth/signup/post', [AuthController::class, 'signupPost'])->name('auth.signup.post');
Route::post('/auth/signin/post', [AuthController::class, 'signinPost'])->name('auth.signin.post');
Route::get('/auth/logout', [AuthController::class, 'logoutPost'])->name('auth.logout');

// auth route end

Route::get('/404', function () {
    return view('404')->with('msg', 'data');
})->name('404');
