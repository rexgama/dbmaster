<?php

use Illuminate\Support\Facades\Route;
use Rexgama\DBMaster\Http\Controllers\AdminController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix('dbmaster')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dbmaster.index');
        Route::post('/schema/{table}/column', [AdminController::class, 'addColumn'])->name('dbmaster.add-column');
        Route::get('/schema/{table}/form', [AdminController::class, 'generateForm'])->name('dbmaster.generate-form');
    });
});