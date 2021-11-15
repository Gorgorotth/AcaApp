<?php

use App\Http\Controllers\Admin\PhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MechanicController;
use App\Http\Controllers\Admin\GarageController;

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('admin.home');

Route::post('/login-store', [LoginController::class, 'store'])->middleware('guest')->name('admin.login');

Route::group(['middleware' => ['auth.admin']], function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/show-invoice/{invoiceId}', [AdminController::class, 'showInvoice'])->name('admin.show-invoice');

    Route::group(['prefix' => '/garage'], function () {

        Route::get('/create', [GarageController::class, 'createGarage'])->name('admin.create-garage');

        Route::post('/store', [GarageController::class, 'storeGarage'])->name('admin.store-garage');

        Route::get('/dashboard', [GarageController::class, 'garageDashboard'])->name('admin.garage-dashboard');

        Route::get('/{garageId}/edit', [GarageController::class, 'edit'])->name('admin.edit-garage');

        Route::post('/delete-email/{emailId}', [GarageController::class, 'deleteEmail'])->name('admin.garage-delete-email');

        Route::post('/restore-email/{emailId}', [GarageController::class, 'restoreEmail'])->name('admin.garage-restore-email');

        Route::post('/remove-mechanic/{mechanicId}', [GarageController::class, 'removeMechanic'])->name('admin.garage-remove-mechanic');

        Route::post('/update/{garageId}', [GarageController::class, 'update'])->name('admin.update-garage');

        Route::post('/delete/{garageId}', [GarageController::class, 'deleteGarage'])->name('admin.garage-delete');

    });
    Route::group(['prefix' => '/mechanic'], function () {

        Route::get('/create', [MechanicController::class, 'createMechanic'])->name('admin.create-mechanic');

        Route::post('/store', [MechanicController::class, 'storeMechanic'])->name('admin.store-mechanic');

        Route::get('/dashboard', [MechanicController::class, 'mechanicDashboard'])->name('admin.mechanic-dashboard');

        Route::get('/{mechanicId}/edit', [MechanicController::class, 'edit'])->name('admin.edit-mechanic');

        Route::post('/update/{mechanicId}', [MechanicController::class, 'update'])->name('admin.update-mechanic');

        Route::post('/delete/{mechanicId}', [MechanicController::class, 'deleteMechanic'])->name('admin.mechanic-delete');

        Route::get('/logout', [LoginController::class, 'destroy'])->name('admin.logout');

    });
});