<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [ApiController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
  Route::get('portfolios', [ApiController::class, 'index']);
  Route::post('portfolios', [ApiController::class, 'store']);
  Route::put('portfolios/{id}', [ApiController::class, 'update']);
  Route::delete('portfolios/{id}', [ApiController::class, 'destroy']);

  Route::post('logout', [ApiController::class, 'logout']);
});
