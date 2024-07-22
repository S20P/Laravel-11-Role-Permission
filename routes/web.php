<?php

use Illuminate\Support\Facades\Route;


//FrontEnd
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Front\{PagesController,ContactUsController};

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



//Pages

Route::get('/about',[PagesController::class, 'about'])->name('front.page.about');;
Route::get('/contact',[ContactUsController::class, 'contact'])->name('front.page.contact');;
Route::post('/contact',[ContactUsController::class, 'contactSave'])->name('front.contact.save');




require __DIR__ . '/admin.php';








