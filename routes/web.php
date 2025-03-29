<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
//use App\Http\Controllers\ProfileController;
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

Auth::routes();

Route::middleware(['admin'])->group(function () {
    Route::get('admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::resource('admin', AdminController::class);
    Route::resource('salary', SalaryController::class);
    Route::get('bonus/{bonus}/edit', [BonusController::class, 'edit'])->name('bonus.edit');
    Route::put('bonus/{bonus}', [BonusController::class, 'update'])->name('bonus.update');
    Route::resource('bonus', BonusController::class)->only(['index', 'create', 'store']);
    Route::get('stripe', [PaymentController::class, 'index'])->name('stripe.index');
    Route::get('stripe/{id}/create', [PaymentController::class, 'create'])->name('stripe.create');
    Route::post('stripe', [PaymentController::class, 'charge'])->name('stripe.charge');
    Route::resource('deduction', DeductionController::class);
    Route::resource('department', DepartmentController::class);
});

Route::middleware(['auth'])->group(function () {
    
});



Route::middleware(['user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user_id}/invoice', [ProfileController::class, 'invoice'])->name('profile.invoice');
    Route::get('/attendance', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

