<?php

use App\Http\Controllers\FirmController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
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
