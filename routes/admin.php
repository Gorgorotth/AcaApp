<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\GarageController;

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('home');

Route::post('login-store', [LoginController::class, 'store'])->middleware('guest')->name('login');

Route::group(['middleware' => ['auth.admin']], function () {

    Route::get('dashboard', [IndexController::class, 'index'])->name('dashboard');

    Route::get('show-invoice/{invoiceId}', [IndexController::class, 'showInvoice'])->name('show-invoice');

    Route::get('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::resource('garage', 'GarageController');

    Route::group(['prefix' => 'garage'], function () {

        Route::post('delete-email/{emailId}', [GarageController::class, 'deleteEmail'])->name('garage-delete-email');

        Route::post('restore-email/{emailId}', [GarageController::class, 'restoreEmail'])->name('garage-restore-email');

        Route::post('remove-mechanic/{mechanicId}', [GarageController::class, 'removeMechanic'])->name('garage-remove-mechanic');

    });

    Route::resource('mechanic', 'MechanicController');

});