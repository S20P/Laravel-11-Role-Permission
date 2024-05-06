<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

//admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'admin','as'=>'admin.'],function(){

  Route::get('/login',[LoginController::class, 'showAdminLoginForm'])->name('login');
  Route::post('/login',[LoginController::class, 'adminLogin']);
  Route::post('/logout',[LoginController::class, 'adminLogout'])->name('logout'); 

  Route::middleware('isAdmin')->group(function(){

     Route::get('/',[AdminDashboard::class, 'index'])->name('dashboard');
     Route::get("/dashboard",[AdminDashboard::class, 'index'])->name('dashboard');

  });
});