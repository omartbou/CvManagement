<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'authenticate'])->name('dashboard');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::post('/add',[DashboardController::class,'addCv'])->name('cv.store');
Route::delete('/cv/{id}', [DashboardController::class, 'deleteCv'])->name('cv.destroy');

});

