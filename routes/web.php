<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserModelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file', function () {
    return view('app.file');
});
Route::post('/pdf', [UserModelController::class, 'pdf']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/send', [UserModelController::class, 'send']);
    Route::get('/mail', [UserModelController::class, 'index']);
});

require __DIR__.'/auth.php';
