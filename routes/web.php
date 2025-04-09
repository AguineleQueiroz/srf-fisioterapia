<?php

use App\Http\Controllers\Srf\MedicalFormsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/entrar');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [MedicalFormsController::class, 'index'])->name('dashboard');
    Route::post('/medical-form', [MedicalFormsController::class, 'store'])->name('medical-form');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
