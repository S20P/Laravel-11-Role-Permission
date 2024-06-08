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
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\SocialMediaSettingController as SMSettingController;




//FrontEnd
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/mail', [MailController::class, 'index'])->name('test');


Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [BlogController::class, 'showCategory'])->name('blog.show.category');
Route::post('/blog/ajax/request', [BlogController::class, 'ajaxRequest'])->name('blog.ajax');


Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('comments/create', [CommentController::class, 'create'])->name('comments.create');
Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::get('comments/{id}', [CommentController::class, 'show'])->name('comments.show');
Route::put('comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


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

    
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('settings/create', [SettingController::class, 'create'])->name('settings.create');
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::get('settings/{id}', [SettingController::class, 'show'])->name('settings.show');
    Route::put('settings/{id}', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');
    Route::POST('/settings-ajax', [SettingController::class, 'ajaxRequestData'])->name('settings.ajax');

    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    // Route::get('comments/create', [AdminCommentController::class, 'create'])->name('comments.create');
    // Route::post('comments', [AdminCommentController::class, 'store'])->name('comments.store');
    Route::get('comments/{id}/edit', [AdminCommentController::class, 'edit'])->name('comments.edit');
    // Route::get('comments/{id}', [AdminCommentController::class, 'show'])->name('comments.show');
    Route::put('comments/{id}', [AdminCommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{id}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
   

    Route::get('/sm-settings', [SMSettingController::class, 'index'])->name('sm-settings.index');
    Route::POST('/sm-settings-ajax', [SMSettingController::class, 'ajaxRequestData'])->name('sm-settings.ajax');
    Route::get('sm-settings/create', [SMSettingController::class, 'create'])->name('sm-settings.create');
    Route::post('sm-settings', [SMSettingController::class, 'store'])->name('sm-settings.store');
    Route::get('sm-settings/{id}/edit', [SMSettingController::class, 'edit'])->name('sm-settings.edit');
    Route::get('sm-settings/{id}', [SMSettingController::class, 'show'])->name('sm-settings.show');
    Route::put('sm-settings/{id}', [SMSettingController::class, 'update'])->name('sm-settings.update');
    Route::delete('sm-settings/{id}', [SMSettingController::class, 'destroy'])->name('sm-settings.destroy');

  });

  
});




