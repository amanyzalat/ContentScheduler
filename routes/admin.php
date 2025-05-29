<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserPlatformController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('posts', PostController::class);
    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/{id}/update', [PostController::class, 'update'])->name('posts.update');
    Route::get('/delete', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('index', [HomeController::class, 'index']);
    Route::get('platforms', [UserPlatformController::class, 'index'])->name('platforms');
    Route::post('platforms/toggle', [UserPlatformController::class, 'toggle'])->name('platforms.toggle');
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('activity-log', [ActivityController::class, 'index'])->name('activity.index');

});
