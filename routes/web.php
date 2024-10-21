<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\doktercontroller;

require __DIR__.'/lpWeb.php';

// Route::get('/', function () {
//     return view('home.app');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('dokter')->group(function(){
    Route::get('/view', [doktercontroller::class, 'index'])->name('dokter.index');
    Route::get('/add', [doktercontroller::class, 'create'])->name('dokter.add');
    Route::post('/store', [doktercontroller::class, 'store'])->name('dokter.store');
    Route::get('/edit/{id}', [doktercontroller::class, 'edit'])->name('dokter.edit');
    Route::post('/update/{id}', [doktercontroller::class, 'update'])->name('dokter.update');
    Route::get('/delete/{id}', [doktercontroller::class, 'delete'])->name('dokter.delete');
});
