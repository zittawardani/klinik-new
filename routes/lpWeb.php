<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LpDokterController;

Route::get('/', [LpDokterController::class, 'index'])->middleware(['auth', 'role:pasien'])->name('/');
