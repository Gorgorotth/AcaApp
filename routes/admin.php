<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MechanicController;
use App\Http\Controllers\Admin\GarageController;

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('home');

Route::post('/login-store', [LoginController::class, 'store'])->middleware('guest')->name('login');

Route::group(['middleware' => ['auth.admin']], function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/show-invoice/{invoiceId}', [AdminController::class, 'showInvoice'])->name('show-invoice');

    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::group(['prefix' => '/garage'], function () {

        Route::get('/create', [GarageController::class, 'createGarage'])->name('create-garage');

        Route::post('/store', [GarageController::class, 'storeGarage'])->name('store-garage');

        Route::get('/dashboard', [GarageController::class, 'garageDashboard'])->name('garage-dashboard');

        Route::get('/{garageId}/edit', [GarageController::class, 'edit'])->name('edit-garage');

        Route::post('/delete-email/{emailId}', [GarageController::class, 'deleteEmail'])->name('garage-delete-email');

        Route::post('/restore-email/{emailId}', [GarageController::class, 'restoreEmail'])->name('garage-restore-email');

        Route::post('/remove-mechanic/{mechanicId}', [GarageController::class, 'removeMechanic'])->name('garage-remove-mechanic');

        Route::post('/update/{garageId}', [GarageController::class, 'update'])->name('update-garage');

        Route::post('/delete/{garageId}', [GarageController::class, 'deleteGarage'])->name('garage-delete');

    });
    Route::group(['prefix' => '/mechanic'], function () {

        Route::get('/create', [MechanicController::class, 'createMechanic'])->name('create-mechanic');

        Route::post('/store', [MechanicController::class, 'storeMechanic'])->name('store-mechanic');

        Route::get('/dashboard', [MechanicController::class, 'mechanicDashboard'])->name('mechanic-dashboard');

        Route::get('/{mechanicId}/edit', [MechanicController::class, 'edit'])->name('edit-mechanic');

        Route::post('/update/{mechanicId}', [MechanicController::class, 'update'])->name('update-mechanic');

        Route::post('/delete/{mechanicId}', [MechanicController::class, 'deleteMechanic'])->name('mechanic-delete');

    });
});