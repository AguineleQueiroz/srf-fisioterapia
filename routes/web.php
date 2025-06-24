<?php

use App\Http\Controllers\Srf\HealthRecordController;
use App\Http\Controllers\Srf\MedicalFormsController;
use App\Http\Controllers\Srf\InformationSecurityPolicyController;
use App\Http\Controllers\Srf\TermsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/entrar');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(MedicalFormsController::class)->group(function () {
        Route::get('/medical-forms', 'index')->name('forms.index');
        Route::post('/medical-forms', 'store')->name('forms.store');
        Route::put('/medical-forms/update', 'update')->name('forms.update');
        Route::get('/medical-forms/all', 'allForms')->name('forms.all');
        Route::get('/medical-forms/{user_id}', 'myForms')->name('forms.me');
    });
    Route::controller(HealthRecordController::class)->group(function () {
        Route::post('/records', 'store')->name('records.store');
    });
    //Information Security Policy - intern
    Route::get('/security/information-security-policy', [InformationSecurityPolicyController::class, 'index'])->name('security.policy');
});

Route::group(['middleware', 'web'], function () {
    Route::get('/use-terms', [TermsController::class, 'index'])->name('terms');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
