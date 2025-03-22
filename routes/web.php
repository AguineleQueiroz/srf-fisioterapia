<?php

use App\Http\Controllers\Srf\MedicalFormsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/entrar');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [MedicalFormsController::class, 'index'])->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
