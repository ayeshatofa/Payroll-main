<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::resource('salary', SalaryController::class);
Route::get('bonus/{bonus}/edit', [BonusController::class, 'edit'])->name('bonus.edit');
Route::put('bonus/{bonus}', [BonusController::class, 'update'])->name('bonus.update');

Route::resource('bonus', BonusController::class)->only(['index', 'create', 'store']);
Route::resource('deduction', DeductionController::class);
Route::resource('department', DepartmentController::class);
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
