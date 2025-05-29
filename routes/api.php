<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlatformController;
// Route of Dashbord

Route::group(
    [],
    function () {
        // auth_Admin
        Route::controller(RegisterController::class)->group(function () {
            Route::post('login_Admin', 'loginAdmin');
            Route::post('/resetPasswords',  'resetPassword');
            Route::post('/confirmPinCode', 'confirmPinCode');
            Route::post('/confirmPassword', 'confirmPassword');
        });
        Route::prefix('admin')->group(function () {
            route::post('', [AdminController::class, 'create']);
        });



        Route::middleware('auth:sanctum')->group(function () {
            // user crud
            Route::prefix('user')->group(function () {
                route::post('', [AdminController::class, 'create']);
                route::get('{id}', [AdminController::class, 'find']);
                route::get('', [AdminController::class, 'get']);
                Route::patch('{id}', [AdminController::class, 'edit']);
                route::delete('{id}', [AdminController::class, 'delete']);
            });
            //posts 
             Route::prefix('posts')->group(function () {
                Route::post('', [PostController::class, 'create']);
                Route::get('', [PostController::class, 'get']);
                Route::patch('{id}', [PostController::class, 'edit']);
                Route::delete('{id}', [PostController::class, 'delete']);
           });
           //Platform
           Route::prefix('platforms')->group(function () {
                Route::get('', [PlatformController::class, 'get']);
                Route::post('toggle', [PlatformController::class, 'toggleUserPlatform']);
           });
            
        });
    }




);
