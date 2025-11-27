<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('chamados', ChamadoController::class);
    Route::get('chamados/close/{id}', [ChamadoController::class, 'close'])->name('chamados.close');
    Route::get('chamados-closed', [ChamadoController::class, 'showAllClosed'])->name('chamados.closed');
    Route::get('chamados/open/{id}', [ChamadoController::class, 'open'])->name('chamados.open');
});

require __DIR__.'/auth.php';
