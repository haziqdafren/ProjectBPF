<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPaketController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\LacakPaketController;
use App\Http\Controllers\HelpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. Now create something great!
|
*/

// Route untuk tambah data paket
Route::get('/tambah-paket', [DataPaketController::class, 'create'])->name('data-paket.create');

// Resource untuk data paket
Route::resource('data-paket', DataPaketController::class);
Route::get('data-paket/{no_resi}/edit', [DataPaketController::class, 'edit'])->name('data-paket.edit');
Route::put('data-paket/{no_resi}', [DataPaketController::class, 'update'])->name('data-paket.update');

// Route for searching packages
Route::get('search-paket', [DataPaketController::class, 'search'])->name('search.paket.data');


Route::resource('histori', HistoriController::class);

// Route for the home page
Route::get('/home', [HomeController::class, 'home'])->name('home');

// Route untuk mencari pada data histori
Route::get('histori/search', [HistoriController::class, 'search'])->name('histori.search');

// Route untuk mencari data paket
Route::get('search-paket', [DataPaketController::class, 'search'])->name('search.paket.data');

// Route untuk melihat index lacakpaket
Route::get('/lacakpaket', [LacakPaketController::class, 'index'])->name('lacak.paket');

// Route untuk mencari pada lacakpaket
Route::get('/lacak-paket/search', [LacakPaketController::class, 'search'])->name('search.paket.lacak');


// Route untuk tampilan bantuan
Route::get('/bantuan', [HelpController::class, 'index'])->name('bantuan');

// Group routes that require authentication
Route::group(['middleware' => 'auth'], function () {
    Route::get('/beranda', [HomeController::class, 'home'])->name('beranda'); // Home page
    Route::post('data-paket', [DataPaketController::class, 'store'])->name('data-paket.store');
    Route::get('billing', function () {
        return view('billing');
    })->name('billing');
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');
    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/profil-user', [InfoUserController::class, 'create']);
    Route::post('/profil-user', [InfoUserController::class, 'store']);
});

// Guest routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// Google authentication routes
Route::get('auth/google', [SessionsController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SessionsController::class, 'handleGoogleCallback']);

// Static pages
Route::get('static-sign-in', function () {
    return view('static-sign-in');
})->name('sign-in');

Route::get('static-sign-up', function () {
    return view('static-sign-up');
})->name('sign-up');
