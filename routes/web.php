<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoutingController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [RoutingController::class, 'homePage'])->name('homePage');
Route::post('/', [RoutingController::class, 'cariPenerbangan'])->name('cariPenerbangan');

# Authentication
Route::get('auth/login', [AuthController::class, 'loginForm'])->name('loginForm')->middleware('prevent.admin');
Route::post('auth/login', [AuthController::class, 'authenticate'])->name('loginProcess')->middleware('prevent.admin');
Route::get('auth/registration', [AuthController::class, 'registrationForm'])->name('registrationForm')->middleware('prevent.admin');
Route::post('auth/registration', [AuthController::class, 'store'])->name('registrationProcess')->middleware('prevent.admin');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('logoutUser')->middleware('prevent.admin');

# Pages
Route::get('jadwal-penerbangan', [RoutingController::class, 'jadwalPenerbangan'])->name('jadwalPenerbangan')->middleware('prevent.admin');
Route::get('booking-penerbangan', [RoutingController::class, 'bookingPenerbangan'])->name('bookingPenerbangan')->middleware('prevent.admin');
Route::get('user/ticket', [RoutingController::class, 'userTicket'])->name('userTicket')->middleware(['auth', 'prevent.admin']);

# Booking
Route::get('booking/{id}', [BookingController::class, 'bookingForm'])->name('bookingForm')->middleware('prevent.admin');
Route::post('booking-process', [BookingController::class, 'processBooking'])->name('processBooking')->middleware(['auth', 'prevent.admin']);
Route::get('pembayaran-booking/{booking_id}', [PaymentController::class, 'paymentForm'])->name('formPembayaran')->middleware(['auth', 'prevent.admin']);
Route::post('pembayaran-booking', [PaymentController::class, 'paymentProcess'])->name('processPayment')->middleware(['auth', 'prevent.admin']);
