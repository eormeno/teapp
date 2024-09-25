<?php

use App\Http\Controllers\ContadorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/contador', [ContadorController::class, 'index'])->name('contador');
Route::get('/contador/incrementar/{número}', [ContadorController::class, 'incrementar'])->name('incrementar');
Route::get('/contador/decrementar/{número}', [ContadorController::class, 'decrementar'])->name('decrementar');

Route::middleware('permission:see-panel')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pull-events', [EventController::class, 'pullEvents'])->name('pull-events');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
