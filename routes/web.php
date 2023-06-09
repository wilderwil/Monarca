<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Categories;
use App\Http\Controllers\PosController;
use App\Http\Controllers\InstallmentsController;
use App\Http\Livewire\pos\Pos;
use App\Http\Controllers\InstallmentsPendingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('pos',[PosController::class,'index'])->name('pos');
    Route::get('pos-report',[PosController::class,'report'])->name('pos-report');
    Route::get('vencidos',[InstallmentsController::class,'index'])->name('vencidos');
    Route::get('pendientes',[InstallmentsPendingController::class,'index'])->name('pendientes');
    Route::get('download-pdf/{id}',[Pos::class,'generatePdf'])->name('download-pdf');

});


require __DIR__.'/auth.php';