<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPaketController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\LacakPaketController;
use App\Models\Histori;

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
// Rute untuk menambah paket
Route::get('/tambah-paket', function () {
    return view('paket'); // Pastikan file 'paket.blade.php' ada di resources/views
})->name('paket.tambah');

Route::get('data-paket/{no_resi}/edit', [DataPaketController::class, 'edit'])->name('data-paket.edit');
Route::put('data-paket/{no_resi}', [DataPaketController::class, 'update'])->name('data-paket.update');

// Rute untuk data paket
Route::resource('data-paket', DataPaketController::class);
Route::resource('histori', HistoriController::class);
Route::get('data-paket', [DataPaketController::class, 'index'])->name('data-paket.index');

// Route untuk pencarian paket di dalam beranda
Route::get('search-paket', [DataPaketController::class, 'search'])->name('search.paket.data');
// Route untuk mencari paket berdasarkan no resi
Route::get('histori', [HistoriController::class, 'index'])->name('histori.index');
Route::get('histori/search', [HistoriController::class, 'search'])->name('histori.search');

// Route to show the edit form
Route::get('histori/{no_resi}/edit', [HistoriController::class, 'edit'])->name('histori.edit');

// Route to update the resource
Route::put('histori/{no_resi}', [HistoriController::class, 'update'])->name('histori.update');

// Route to show the resource (if needed)
Route::get('histori/{no_resi}', [HistoriController::class, 'show'])->name('histori.show');

// Route untuk pencarian paket di halaman lacak paket
Route::get('search-lacak-paket', [LacakPaketController::class, 'search'])->name('search.paket.lacak');

// Route::get('/data-paket', [DataPaketController::class, 'index'])->name('data-paket.index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/beranda', [HomeController::class, 'home'])->name('beranda'); // Menggunakan controller untuk beranda
    Route::get('cari-paket', [DataPaketController::class, 'search'])->name('search.paket.data'); // Route untuk pencarian

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');


	// Route::get('histori', function () {
	// 	return view('laravel-examples/histori');
	// })->name('histori');

	// Route::get('dataPaket', function () {
	// 	return view('dataPaket');
	// })->name('dataPaket');

	Route::get('tambahPaket', function () {
		return view('paket');
	})->name('tambah-paket');

	Route::get('editPaket', function () {
		return view('editPaket');
	})->name('edit-paket');


    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/lacakpaket', [InfoUserController::class, 'lacakpaket'])->withoutMiddleware('auth');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('beranda');
	})->name('sign-up');
});



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

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');


Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::resource('data_pakets', DataPaketController::class);
