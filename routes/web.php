<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminAttendanceController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Default verification notice page
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    if (Auth::user()->role == 'admin') {
        return '/admin';  // Redirect admin to the admin dashboard
    } else {
        return redirect()->route('profile.index');  // Redirect normal users to their profile
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('autocomplete', [AdminController::class, 'autocomplete'])->name('autocomplete');
    Route::get('admin/searchForm', [AdminController::class, 'searchForm'])->name('admin.searchForm');
    Route::get('admin/feedback', [AdminController::class, 'indexAdmin'])->name('feedback.indexAdmin');
    Route::resource('admin', AdminController::class);
    Route::resource('attendance', AdminAttendanceController::class);
    Route::resource('position', PositionController::class);
    Route::resource('salary', SalaryController::class);
    Route::get('bonus/{bonus}/edit', [BonusController::class, 'edit'])->name('bonus.edit');
    Route::put('bonus/{bonus}', [BonusController::class, 'update'])->name('bonus.update');
    Route::delete('bonus/{bonus}', [BonusController::class, 'destroy'])->name('bonus.destroy');
    Route::get('bonus/{bonus}', [BonusController::class, 'show'])->name('bonus.show');
    Route::resource('bonus', BonusController::class)->only(['index', 'create', 'store']);
    Route::get('stripe', [PaymentController::class, 'index'])->name('stripe.index');
    Route::get('stripe/{id}/create', [PaymentController::class, 'create'])->name('stripe.create');
    Route::post('stripe', [PaymentController::class, 'charge'])->name('stripe.charge');
    Route::resource('deduction', DeductionController::class);
    Route::resource('department', DepartmentController::class);
});



Route::middleware(['auth', 'user', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/attendance', [ProfileController::class, 'attendance'])->name('profile.attendance');
    Route::get('/profile/deduction', [ProfileController::class, 'deduction'])->name('profile.deduction');
    Route::get('/profile/bonus', [ProfileController::class, 'bonus'])->name('profile.bonus');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user_id}/invoice', [ProfileController::class, 'invoice'])->name('profile.invoice');
    Route::get('/profile/invoice/{id}/download', [ProfileController::class, 'downloadInvoice'])->name('profile.invoice.download');
    Route::get('/attendances', [AttendancesController::class, 'create'])->name('attendances.create');
    Route::post('/attendances', [AttendancesController::class, 'store'])->name('attendances.store');
    Route::resource('feedback', FeedbackController::class);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

