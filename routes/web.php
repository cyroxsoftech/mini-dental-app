<?php

use App\Http\Controllers\CentralController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CentralController::class, 'welcome'])->name('welcome');

Route::post('/verify-clinic',[CentralController::class, 'verifyClinic'])->name('clinic.verify');