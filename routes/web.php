<?php

use App\Http\Controllers\FirmController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('index');
})->name('home');

Route::get("/firmalar", [FirmController::class, "index"])->name("firmalar.index");
Route::get("/firmalar/yeni/{firm?}", [FirmController::class, "create"])->name("firmalar.create");
Route::post("/firmalar", [FirmController::class, "store"])->name("firmalar.store");
Route::delete("/firmalar/{firm}", [FirmController::class, "destroy"])->name("firmalar.destroy");


Route::get('/firmalar/{id}/edit', [FirmController::class, 'edit'])->name('firmalar.edit');
Route::put('/firmalar/{id}', [FirmController::class, 'update'])->name('firmalar.update');

Route::get('/firmalar/{id}/show', [FirmController::class, 'show'])->name('firmalar.show');

Route::post("transaction/{id}", [TransactionController::class, "store"])->name("firmalar.transaction");

Route::delete("transaction/{id}", [TransactionController::class, "destroy"])->name("transaction.destroy");

Route::get('/transaction/{id}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('/transaction/{id}', [TransactionController::class, 'update'])->name('transaction.update');

Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
Route::get('/stocks/{id}/edit', [StockController::class, 'edit'])->name('stocks.edit');
Route::put("/stocks/{id}", [StockController::class, 'update'])->name('stocks.update');
Route::delete("/stocks/{id}", [StockController::class, 'destroy'])->name('stocks.destroy');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'dashboard' : 'login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


Auth::routes();
