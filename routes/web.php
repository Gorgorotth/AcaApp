<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mechanic\MechanicController;
use App\Http\Controllers\Mechanic\LoginController;

Route::get('/', [LoginController::class, 'index'])->name('home');

Route::post('login', [LoginController::class, 'store'])->name('mechanic.login');

Route::group(['prefix' => 'mechanic', 'middleware' => ['auth']], function () {

    Route::get('logout', [LoginController::class, 'destroy'])->name('mechanic.logout');

    Route::get('edit-mechanic', [MechanicController::class, 'editProfile'])->name('mechanic.edit-mechanic');

    Route::post('edit-mechanic-profile', [MechanicController::class, 'editMechanicProfile'])->name('mechanic.edit-mechanic-profile');

    Route::post('change-mechanic-password', [MechanicController::class, 'changeMechanicPassword'])->name('mechanic.change-mechanic-password');

    Route::get('dashboard', [MechanicController::class, 'index'])->name('mechanic.dashboard');

    Route::get('invoice/show/{invoiceId}', [MechanicController::class, 'showInvoice'])->name('mechanic.showInvoice');

    Route::get('invoice/createInvoice', [MechanicController::class, 'createInvoice'])->name('mechanic.createInvoice');

    Route::get('invoice/exportToPdf/{invoiceId}', [MechanicController::class, 'exportPdf'])->name('mechanic.exportInvoiceToPdf');

    Route::post('invoice/storeInvoice', [MechanicController::class, 'storeInvoice'])->name('mechanic.storeInvoice');

    Route::post('invoice/delete/{invoiceId}', [MechanicController::class, 'deleteInvoice'])->name('mechanic.deleteInvoice');

});

Route::fallback(function () {
    return response(view('mechanic.errors.404'),404);
});