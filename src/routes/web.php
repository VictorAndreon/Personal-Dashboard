<?php

use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* TODO
- Ajustar Nomenclatura do Controller e do Model para fazer sentido.
- Ajustar Create.blade da tela de financeiro.
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/financeiro',FinanceiroController::class)->except('show','edit')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
