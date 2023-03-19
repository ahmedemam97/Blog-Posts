<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PagesController;

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
        return view('main');
});
Auth::routes();


Route::resource('/blog', PostController::class);

Route::get('/blogs', [PagesController::class, 'blogs']);
Route::get('/main', [PagesController::class, 'main']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
