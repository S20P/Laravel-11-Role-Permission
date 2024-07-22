<?php
use Illuminate\Support\Facades\Route;

Auth::routes();

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
use App\Http\Controllers\Admin\AdInserterController as AdInserter;


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
      
      Route::get('/ad-inserter-settings', [AdInserter::class, 'index'])->name('ad-inserter-settings.index');
      Route::POST('/ad-inserter-settings-ajax', [AdInserter::class, 'ajaxRequestData'])->name('ad-inserter-settings.ajax');
      Route::get('ad-inserter-settings/create', [AdInserter::class, 'create'])->name('ad-inserter-settings.create');
      Route::post('ad-inserter-settings', [AdInserter::class, 'store'])->name('ad-inserter-settings.store');
      Route::get('ad-inserter-settings/{id}/edit', [AdInserter::class, 'edit'])->name('ad-inserter-settings.edit');
      Route::get('ad-inserter-settings/{id}', [AdInserter::class, 'show'])->name('ad-inserter-settings.show');
      Route::put('ad-inserter-settings/{id}', [AdInserter::class, 'update'])->name('ad-inserter-settings.update');
      Route::delete('ad-inserter-settings/{id}', [AdInserter::class, 'destroy'])->name('ad-inserter-settings.destroy');
  
    });
  
    
  });

