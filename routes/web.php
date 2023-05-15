<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;


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
    return view('auth.login');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile/detail', [ProfileController::class, 'show'])->name('profile.detail');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(CommentController::class)->group(function () {
        Route::get('/dashboard', 'index')->middleware(['auth', 'verified'])->name('dashboard');
        Route::get('/mydashboard', 'mydashboard')->middleware(['auth', 'verified'])->name('mydashboard');
        Route::get('/mylikes', 'mylikes')->middleware(['auth', 'verified'])->name('mylikes');
        Route::get('/comments/new', 'create')->name('comments.create');
        Route::post('/comments/store', 'store')->name('comments.store');
        Route::post('/comments/delete/{comment}', 'destroy')->name('comments.destroy');
        Route::get('/comments/edit/{comment}', 'edit')->name('comments.edit');
        Route::post('/comments/update/{comment}', 'update')->name('comments.update');
        Route::get('/comments/detail/{comment}', 'show')->name('comments.show');
        Route::post('/comments/{comment}/toggleLike', 'toggleLike')->name('comments.toggleLike');
    });
});



Route::get('/profile/comments', 'App\Http\Controllers\ProfileController@showComments')->name('profile.comments');
Route::get('/profile/likes', 'App\Http\Controllers\ProfileController@showLikes')->name('profile.likes');

require __DIR__.'/auth.php';
