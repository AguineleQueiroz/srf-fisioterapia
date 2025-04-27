<?php

use App\Http\Controllers\Srf\MedicalFormsController;
use App\Http\Controllers\Srf\PoliciesController;
use App\Http\Controllers\Srf\TermsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/entrar');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [MedicalFormsController::class, 'index'])->name('dashboard');
    Route::post('/medical-form', [MedicalFormsController::class, 'store'])->name('medical-form');
    Route::get('/user/basic-medical-forms/{user_id}', [MedicalFormsController::class, 'myBasicMedicalForms'])->name('my-medical-forms');
    Route::get('/medical-forms', [MedicalFormsController::class, 'allBasicMedicalForms'])->name('medical-forms');

    Route::get('/terms', [TermsController::class, 'index'])->name('terms');
    Route::get('/policies', [PoliciesController::class, 'index'])->name('policies');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
