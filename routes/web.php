<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CoupleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\MaintenanceEntryController;
use App\Http\Controllers\Admin\HallController;

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

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin.index');
        Route::resource('schedules', ScheduleController::class);
        Route::resource('maintenances', MaintenanceController::class)->except(['create', 'show']);
        Route::resource('maintenanceEntries', MaintenanceEntryController::class)->except(['create', 'show']);
        Route::resource('halls', HallController::class);
        Route::put('maintenanceEntries/{maintenanceEntry}/confirm', [MaintenanceEntryController::class, 'confirm'])->name('maintenanceEntries.confirm');
        Route::get('schedules/{schedule}/couples/edit', [CoupleController::class, 'edit'])->name('couples.edit');
        Route::put('schedule/{schedule}/couples', [CoupleController::class, 'update'])->name('couples.update');
        Route::post('roles/{user}', [RoleController::class, 'store'])->name('roles.store');
        Route::delete('roles/{user}/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::middleware('verified')->group(function () {
        Route::resource('profiles', ProfileController::class)->only(['show', 'edit']);
        Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
    });

    Route::put('/entries/book', [EntryController::class, 'book'])->name('entries.book');
    Route::put('/entries/pay/{entry}', [StoreController::class, 'pay'])->name('entries.pay');
    Route::put('/entries/pass/{entry}', [StoreController::class, 'pass'])->name('entries.pass');
    Route::delete('/entries/{entry}', [StoreController::class, 'destroy'])->name('entries.destroy');
});

Route::get('/schedules/active', [ScheduleController::class, 'active'])->name('schedules.active');
Route::get('/check', [EntryController::class, 'check'])->name('entries.check');

Route::get('/', [MainController::class, 'welcome'])->name('main');
Route::get('/entries/my', [StoreController::class, 'getEntries'])->name('entries.index');
//Route::get('/check', [EntryController::class, 'check'])->name('entries.check');
//Route::get('/entries/get', [EntryController::class, 'getEntries']);
