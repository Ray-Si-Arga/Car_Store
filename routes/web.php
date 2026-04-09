<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Car\CarController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\Notification\NotifController;
use App\Http\Controllers\Booking\Admin\BookingAdminController;
use App\Http\Controllers\Booking\Customer\CustomerBookingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;
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
Route::group(['middleware' => ['cek.login', 'auth']], function () {

    // ======= Customer Dashboard ========
    Route::get('customer/dashboard', [DashboardController::class, 'indexCustomer'])->name('customer.dashboard');

    // ========== Customer Car ========== 
    Route::get('/customer/car', [CarController::class, 'index'])->name('customer.car');

    // ========== Customer Booking ========== 
    Route::get('/customer/booking/form/{car_id}', [CustomerBookingController::class, 'form'])->name('customer.booking.create');
    Route::post('/customer/booking/store', [CustomerBookingController::class, 'store'])->name('customer.booking.store');
    Route::get('/customer/riwayat', [CustomerBookingController::class, 'riwayat'])->name('customer.riwayat');
    Route::get('/customer/riwayat/show', [CustomerBookingController::class, 'show'])->name('customer.riwayat.show');
    Route::get('/customer/riwayat/{id}/bayar', [CustomerBookingController::class, 'formBayar'])->name('customer.riwayat.bayar');
    Route::post('/customer/riwayat/{id}/upload-bukti', [CustomerBookingController::class, 'uploadBukti'])->name('customer.riwayat.upload');

    // Profile Technical Info
    Route::post('/customer/profile/complete', [ProfileController::class, 'updateTechnicalInfo'])->name('customer.profile.complete');
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
    Route::put('/admin/car/update/{id}', [CarController::class, 'update'])->name('admin.car.update');
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

