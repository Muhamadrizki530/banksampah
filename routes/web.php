<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\WasteTransactionController;
use App\Http\Controllers\Admin\WasteTypeController;
use App\Http\Controllers\Admin\GroceryController;
use App\Http\Controllers\Admin\RedemptionController;


// Nasabah
use App\Http\Controllers\Nasabah\DashboardController as NasabahDashboardController;
use App\Http\Controllers\Nasabah\RedemptionController as NasabahRedemptionController;
use App\Http\Controllers\Nasabah\StatisticsController;
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD Nasabah
        Route::resource('nasabah', NasabahController::class);

        // CRUD Transaksi Sampah
        Route::resource('waste-transactions', WasteTransactionController::class);
        Route::resource('waste-types', WasteTypeController::class);
        Route::resource('groceries', GroceryController::class);
        Route::get(
            'waste-transactions/{wasteTransaction}/receipt',
            [WasteTransactionController::class, 'receipt']
        )->name('waste-transactions.receipt');
        Route::get(
            'waste-transactions/{wasteTransaction}/pdf',
            [WasteTransactionController::class, 'downloadPdf']
        )->name('waste-transactions.pdf');

        // Redemption History
        Route::get('/redemptions', [RedemptionController::class, 'index'])
            ->name('admin.redemptions.index');
    });

/*
|--------------------------------------------------------------------------
| Nasabah
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('nasabah')
    ->name('nasabah.')
    ->group(function () {

        Route::get('/dashboard', [NasabahDashboardController::class, 'index'])
            ->name('dashboard');

        // Tukar Poin
        Route::get('/tukar-poin', [NasabahRedemptionController::class, 'index'])
            ->name('tukar-poin');

        Route::post('/tukar-poin', [NasabahRedemptionController::class, 'store'])
            ->name('tukar-poin.store');

        // Riwayat Penukaran
        Route::get('/riwayat-penukaran', [NasabahRedemptionController::class, 'history'])
            ->name('riwayat-penukaran');

       Route::post('/tukar-poin/checkout', [NasabahRedemptionController::class, 'checkout'])
            ->name('tukar-poin.checkout');


        // Statistik
        Route::get('/statistik', [StatisticsController::class, 'index'])
            ->name('statistik');
        // Profil
        Route::get('/profil', [ProfileController::class, 'edit'])
            ->name('profil');
        Route::get('/riwayat-penukaran/{redemption}', [NasabahRedemptionController::class, 'show'])
            ->name('redemptions.show');
            
    });

/*


|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
