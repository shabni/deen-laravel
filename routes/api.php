<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => ['role:client']], function () {
        Route::get('client/dashboard', function () {
            return response()->json(['message' => 'Client dashboard']);
        });
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('admin/dashboard', function () {
            return response()->json(['message' => 'Admin dashboard']);
        });
    });

    // Example: Allow both admin and ulama users
    Route::group(['middleware' => ['role:admin,ulama']], function () {
        Route::get('ulama/dashboard', function () {
            return response()->json(['message' => 'Ulama dashboard']);
        });
    });

    // Other protected routes can go here
    Route::get('user', function () {
        return auth()->user();
    });
});
