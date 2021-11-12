<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MechanicController;

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('admin.home');

Route::post('/login-store', [LoginController::class, 'store'])->middleware('guest')->name('admin.login');

Route::group(['middleware' => ['auth.admin']], function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/show-invoice/{invoiceId}', [AdminController::class, 'showInvoice'])->name('admin.show-invoice');

    Route::get('/create-garage', [AdminController::class, 'createGarage'])->name('admin.create-garage');

    Route::post('/store-garage', [AdminController::class, 'storeGarage'])->name('admin.store-garage');

    Route::get('/create-mechanic', [MechanicController::class, 'createMechanic'])->name('admin.create-mechanic');

    Route::post('/store-mechanic', [MechanicController::class, 'storeMechanic'])->name('admin.store-mechanic');

    Route::get('/mechanic-dashboard', [MechanicController::class, 'mechanicDashboard'])->name('admin.mechanic-dashboard');

    Route::get('/mechanic-edit/{mechanicId}', [MechanicController::class, 'edit'])->name('admin.edit-mechanic');

    Route::post('/mechanic-update', [MechanicController::class, 'update'])->name('admin.update-mechanic');

    Route::post('/mechanic-delete/{mechanicId}', [MechanicController::class, 'deleteMechanic'])->name('admin.mechanic-delete');

    Route::get('/logout', [LoginController::class, 'destroy'])->name('admin.logout');

});