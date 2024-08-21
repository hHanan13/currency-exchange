<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AmountController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');
Route::post('/currencies/update', [CurrencyController::class, 'update'])->name('currencies.update');

Route::get('/currencies/create', [CurrencyController::class, 'create'])->name('currencies.create');
Route::post('/currencies', [CurrencyController::class, 'store'])->name('currencies.store');
Route::post('/currencies/delete', [CurrencyController::class, 'destroy'])->name('currencies.destroy');


// Routes for managing amounts
Route::get('/amounts', [AmountController::class, 'index'])->name('amounts.index');
Route::get('/amounts/create', [AmountController::class, 'create'])->name('amounts.create');
Route::post('/amounts', [AmountController::class, 'store'])->name('amounts.store');
Route::get('/amounts/{id}/edit', [AmountController::class, 'edit'])->name('amounts.edit');
Route::post('/amounts/{id}/update', [AmountController::class, 'update'])->name('amounts.update');
Route::post('/amounts/{id}/delete', [AmountController::class, 'destroy'])->name('amounts.destroy');