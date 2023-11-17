<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OpenScheduleController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SiteController;
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




Route::get('/api/bookings/calendar', [BookingController::class, 'calendar'])->name('bookings.calendar'); //API
Route::get('/api/packages/{id}', [PackageController::class, 'find_api'])->name('bookings.findapi'); //API
Route::get('/schedules/open/{day}', [OpenScheduleController::class, 'getSchedulesByDay'])->name('schedules.open');
// Route::get('/schedules/open/{day}', )->name('schedules.open');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:administrative|commercial'])->group(function(){
        Route::delete('/guests/delete/{id}', [GuestController::class,'delete'])->name('guests.delete');

        Route::get('/packages/{slug}/edit', [PackageController::class, 'edit'])->name('packages.edit');
        Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
        Route::post('/packages/store', [PackageController::class, 'store'])->name('packages.store');
        Route::delete('/packages/delete', [PackageController::class,'delete'])->name('packages.delete');
        Route::put('/packages/{id}',[PackageController::class,'update'])->name('packages.update');

        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::delete('/bookings/negar/{id}', [BookingController::class,'negar'])->name('bookings.negar');
        Route::get('/bookings/list', [BookingController::class, 'list'])->name('bookings.list');

        Route::get('/schedules', [OpenScheduleController::class, 'index'])->name('schedules.index');
        Route::get('/schedules/{id}/edit', [OpenScheduleController::class, 'edit'])->name('schedules.edit');
        Route::get('/schedules/create', [OpenScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/schedules/store', [OpenScheduleController::class, 'store'])->name('schedules.store');
        Route::delete('/schedules/delete/{id}', [OpenScheduleController::class,'delete'])->name('schedules.delete');
        Route::put('/schedules/{id}',[OpenScheduleController::class,'update'])->name('schedules.update');
        Route::get('/schedules/{id}', [OpenScheduleController::class, 'find'])->name('schedules.show');

        Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');
        Route::get('/recommendations/{id}/edit', [RecommendationController::class, 'edit'])->name('recommendations.edit');
        Route::get('/recommendations/create', [RecommendationController::class, 'create'])->name('recommendations.create');
        Route::post('/recommendations/store', [RecommendationController::class, 'store'])->name('recommendations.store');
        Route::delete('/recommendations/delete/{id}', [RecommendationController::class,'delete'])->name('recommendations.delete');
        Route::put('/recommendations/{id}',[RecommendationController::class,'update'])->name('recommendations.update');
        Route::get('/recommendations/{id}', [RecommendationController::class, 'find'])->name('recommendations.show');
    });

    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/not_found', [PackageController::class, 'not_found'])->name('packages.not_found');
    Route::get('/packages/{slug}', [PackageController::class, 'find'])->name('packages.show');
    
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::get('/guests/not_found', [GuestController::class, 'not_found'])->name('guests.not_found');
    Route::get('/guests/{booking}/approved', [GuestController::class, 'approved'])->name('guests.approved');
    Route::get('/guests/{booking}/invite', [GuestController::class, 'invite'])->name('guests.invite');
    Route::post('/guests/store', [GuestController::class, 'store'])->name('guests.store');
    Route::get('/guests/{id}', [GuestController::class, 'find'])->name('guests.show');
    Route::patch('/guests/{id}/status', [GuestController::class,'updateStatus'])->name('guests.updateStatus');

    // Aniversariante
    Route::get('/bookings/not_found', [BookingController::class, 'not_found'])->name('bookings.not_found');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/delete/{id}', [BookingController::class,'delete'])->name('bookings.delete');
    Route::get('/bookings/{id}', [BookingController::class, 'find'])->name('bookings.show');
    Route::put('/bookings/{id}',[BookingController::class,'update'])->name('bookings.update');
    
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
