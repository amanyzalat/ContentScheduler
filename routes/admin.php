<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TaskController;
use App\Models\User;
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
Route::get('/user', function () {
     $y=User::first();
     $y->password=Illuminate\Support\Facades\Hash::make('admin@24');
     $y->save();
     return $y;
});
 
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('tasks', TaskController::class);
    Route::get('statistics', [TaskController::class, 'statistics'])->name('tasks.statistics');
    Route::get('/{id}/edit', [TaskController::class,'edit'])->name('tasks.edit');
    Route::post('/{id}/update', [TaskController::class,'update'])->name('tasks.update');
    Route::get('/delete', [TaskController::class,'destroy'])->name('tasks.destroy');
    Route::get('index',[HomeController::class,'index']);
});


