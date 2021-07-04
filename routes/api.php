<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Using API resources to perform CRUD on the different endpoint. It is more standard.
Route::apiResources([
    'rentals' => RentalController::class,
    'movies'=> MovieController::class,
]);

use App\Http\Controllers\AuthController;

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



//Protected routes
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

