<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Car\CarController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\Notification\NotifController;
use App\Http\Controllers\Booking\BookingAdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Booking\BookingUserController;
use App\Http\Controllers\PricingGlobe\PricingController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/**
 * ========== Landing Page Option ==========
 */
Route::get('/cars', [LandingPageController::class, 'index'])->name('cars');

/**
 * ========== OAuth Routes Google ==========
 */
// penjelasan mengarahkan user ke penyedia OAuth atau google sendiri
Route::get('/auth/google/redirect', [SocialiteController::class, 'redirect'])->name('google.redirect');

// penjelasan mengembalikan user ke laravel setelah otentikasi dari penyedia OAuth atau google
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

/**
 * ============ Rute login & Registrasi ============
 */

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/aksi', [AuthController::class, 'login_aksi'])->name('login_aksi');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi/aksi', [AuthController::class, 'registrasi_aksi'])->name('registrasi.aksi');

/**
 * ========= Customer Routes ==========
 */
Route::group(['middleware' => ['auth']], function () {

    // ======= Customer Dashboard ========
    Route::get('customer/dashboard', function () {
        return view('customer.dashboard');
    });

    // ========== Customer Booking ========== 
    Route::get('/customer/booking/create/{car_id}', [BookingUserController::class, 'create'])->name('customer.booking.create');
    Route::post('/customer/booking/store', [BookingUserController::class, 'store'])->name('customer.booking.store');
    Route::get('/customer/bookings', [BookingUserController::class, 'riwayat'])->name('customer.bookings');
    Route::get('/customer/bookings/show', [BookingUserController::class, 'show'])->name('customer.bookings.show');
    Route::get('/customer/booking/{id}/bayar', [BookingUserController::class, 'formBayar'])->name('customer.booking.bayar');
    Route::post('/customer/booking/{id}/upload-bukti', [BookingUserController::class, 'uploadBukti'])->name('customer.booking.upload');
});


/**
 * ========== Admin Routes ==========
 **/
Route::middleware(['admin'])->group(function () {

    // ======== Admin Dashboard =========
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ======== Admin User =========
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::put('/admin/put/{id}', [UserController::class, 'edit_aksi'])->name('admin.edit_aksi');
    Route::delete('/admin/delete/{id}', [UserController::class, 'delete'])->name('admin.delete');

    // ======== Admin Car =========
    Route::get('/admin/car', [CarController::class, 'index'])->name('admin.car');
    Route::post('/admin/car/store', [CarController::class, 'store'])->name('admin.car.store');
    Route::delete('/admin/car/destroy/{id}', [CarController::class, 'destroy'])->name('admin.car.delete');

    // ======== Admin Global Pricing =========
    Route::post('/admin/car/global-price', [PricingController::class, 'pricing_globe'])->name('admin.global-pricing.store');
    Route::delete('/admin/car/global-price/{id}', [PricingController::class, 'destroy_price'])->name('admin.global-pricing.delete');


    Route::get('/admin/notification', [NotifController::class, 'index'])->name('admin.notification');

    // Admin Booking
    Route::get('/admin/bookings', [BookingAdminController::class, 'adminIndex'])->name('admin.bookings');
    Route::get('/admin/bookings/{id}', [BookingAdminController::class, 'adminShow'])->name('admin.bookings.show');
    Route::put('/admin/bookings/{id}/approve', [BookingAdminController::class, 'approve'])->name('admin.bookings.approve');
    Route::put('/admin/bookings/{id}/reject', [BookingAdminController::class, 'reject'])->name('admin.bookings.reject');
    Route::put('/admin/bookings/{id}/selesai', [BookingAdminController::class, 'selesai'])->name('admin.bookings.selesai');
});

