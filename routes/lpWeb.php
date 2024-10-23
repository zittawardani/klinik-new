<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LpDokterController;

Route::get('/', [LpDokterController::class, 'index']); //file yang isinya route landingpage
