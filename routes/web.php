<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/bookings/calendar', [BookingController::class, 'calendar'])->name('bookings.calendar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
    Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages/store', [PackageController::class, 'store'])->name('packages.store');
    Route::delete('/packages/delete', [PackageController::class,'delete'])->name('packages.delete');
    Route::put('/packages/{id}',[PackageController::class,'update'])->name('packages.update');
    Route::get('/packages/{id}', [PackageController::class, 'find'])->name('packages.show');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/delete', [BookingController::class,'delete'])->name('bookings.delete');
    Route::put('/bookings/{id}',[BookingController::class,'update'])->name('bookings.update');
    Route::get('/bookings/{id}', [BookingController::class, 'find'])->name('bookings.show');
    /**
     * Formatos de utilização dos middlewares de permissionamento:
     * - Pela definição da rota
     * - Em um construtor do controller
     */

    // // Na definição da rota
    // Route::get('/rota', function() {

    // })
    // ->middleware('role:user|commercial'); // usuarios e comercial podem utilizar
    // ->middleware('permission:create package|edit package'); // usuarios que possuem a permissao 'create package' ou 'edit package' podem alterar
    // ->middleware('role_or_permission:commercial|create package') //usuarios que possuirem a permissao ou o cargo

    // // No controller
    // public function __construct() {
    //     $this->middleware('mesma coisa de cima', ['only'=>['metodos', 'que', 'executarao', 'o', 'middleware']]);
    //     $this->middleware('mesma coisa de cima', ['except'=>['metodos', 'que', 'nao', 'executarao', 'o', 'middleware']]);
    // }
});

require __DIR__.'/auth.php';
