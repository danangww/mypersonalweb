<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [WebController::class, 'index']);

Auth::routes(['register' => false, 'confirm' => false]);

Route::group(['middleware' => ['auth']], function () {
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::resource('/categories', CategoryController::class);
  Route::resource('/portfolios', PortfolioController::class);
});
