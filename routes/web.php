<?php

use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('chamados', ChamadoController::class);
    Route::get('chamados/close/{id}', [ChamadoController::class, 'close'])->name('chamados.close');
    Route::get('chamados-closed', [ChamadoController::class, 'showAllClosed'])->name('chamados.closed');
    Route::get('chamados/open/{id}', [ChamadoController::class, 'open'])->name('chamados.open');
    Route::get('chamados/mensagens/{id}', [ChamadoController::class, 'mensagens'])->name('chamados.mensagens');
    Route::resource('mensagens', MensagemController::class)->only(['create', 'store']);
    Route::resource('artigos', ArtigoController::class);
    Route::resource('feedbacks', FeedbacksController::class)->only(['store', 'getNota']);
});

require __DIR__.'/auth.php';
