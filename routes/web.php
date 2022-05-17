<?php

use Illuminate\Support\Facades\Route;
use App\Models\Articles; 
use App\Models\User; 

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');
Route::get('/article/{id}', [App\Http\Controllers\WelcomeController::class, 'show'])->name('show');
Route::get('showimg', [App\Http\Controllers\WelcomeController::class, 'showimg'])->name('showimg');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('articles', App\Http\Controllers\ArticlesController::class);
});
