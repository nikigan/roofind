<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('users', UsersController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});

Route::middleware(['auth:web,admin'])->group(function () {
    Route::resource('projects', 'ProjectController');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web,admin'])->name('dashboard');


require __DIR__ . '/auth.php';
