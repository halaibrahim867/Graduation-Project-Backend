<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserView\ActivityPlaceController;
use App\Http\Controllers\UserView\CowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes
Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'login']);
Route::post('password/forget-password',[ForgetPasswordController::class,'forgetPassword']);
Route::post('password/reset',[ResetPasswordController::class,'resetPassword']);

//protected routes
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::post('/logout',[LogoutController::class,'logout']);
    //cow routes
    Route::get('/cows',[CowController::class,'index']);
    Route::get('/cows/show/{id}',[CowController::class,'show'])->name('show_cow');
    Route::get('/cows/search',[CowController::class,'search'])->name('find_cow');

    Route::get('/activity_places',[ActivityPlaceController::class,'index']);
    Route::get('/activity_places/{id}',[ActivityPlaceController::class,'show']);

});
