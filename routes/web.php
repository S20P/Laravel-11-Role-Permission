<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

//admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\BlogPostController;

//FrontEnd
use App\Http\Controllers\BlogController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/ajax/request', [BlogController::class, 'ajaxRequest'])->name('blog.ajax');

/*----------------------
    ADMIN ROUTES
-----------------------*/
Route::group(['prefix' => 'admin', 'as'=>'admin.'],function(){


  Route::get('/login',[LoginController::class, 'showAdminLoginForm'])->name('login');
  Route::post('/login',[LoginController::class, 'adminLogin']);
  Route::post('/logout',[LoginController::class, 'adminLogout'])->name('logout'); 

  Route::middleware(['isAdmin'])->group(function(){
    
     Route::get('/',[AdminDashboard::class, 'index'])->name('dashboard');
     Route::get("/dashboard",[AdminDashboard::class, 'index'])->name('dashboard');

     Route::resources([
      'permissions' => PermissionsController::class,
      'roles' => RoleController::class,
      'users' => UserController::class,
      'categories' => CategoryController::class,      
    ]);

    Route::get('/blogs', [BlogPostController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create', [BlogPostController::class, 'create'])->name('blogs.create');
    Route::post('blogs', [BlogPostController::class, 'store'])->name('blogs.store');
    Route::get('blogs/{id}/edit', [BlogPostController::class, 'edit'])->name('blogs.edit');
    Route::get('blogs/{id}', [BlogPostController::class, 'show'])->name('blogs.show');
    Route::put('blogs/{id}', [BlogPostController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/{id}', [BlogPostController::class, 'destroy'])->name('blogs.destroy');
   
  });

  
});




