<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Material\MaterialController;
use App\Http\Controllers\Office\OfficeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /**
     * CRUD Materials
     */
    Route::get('materials', [MaterialController::class, 'index'])->name('material.index');
    Route::get('materials/new', [MaterialController::class, 'create'])->name('material.create');
    Route::post('materials/new', [MaterialController::class, 'store'])->name('material.store');
    Route::get('materials/{material}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('materials/{material}/update', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('materials/{material}/remove', [MaterialController::class, 'destroy'])->name('material.destroy');
    Route::put('materials/{material}/update-status', [MaterialController::class, 'updateStatus'])->name('material.status');

    /**
     * CRUD Offices
     */
    Route::get('offices', [OfficeController::class, 'index'])->name('office.index');
    Route::get('offices/new', [OfficeController::class, 'create'])->name('office.create');
    Route::post('offices/new', [OfficeController::class, 'store'])->name('office.store');
    Route::get('offices/{office}/edit', [OfficeController::class, 'edit'])->name('office.edit');
    Route::put('offices/{office}/update', [OfficeController::class, 'update'])->name('office.update');
    Route::delete('offices/{office}/remove', [OfficeController::class, 'destroy'])->name('office.destroy');

    /**
     * CRUD Users Collaborators
     */
    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('users/new', [UserController::class, 'create'])->name('user.create');
    Route::post('users/new', [UserController::class, 'store'])->name('user.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('users/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{user}/remove', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('users/{user}/update-status', [UserController::class, 'updateStatus'])->name('user.status');

    /**
     * Movements of Materials - Flow
     */
    Route::post('addNewMovementRegister', [HomeController::class, 'addNewMovementRegister'])->name('movement.store');
    Route::get('/movements/export-excel', [HomeController::class, 'exportExcel'])->name('movements.exportExcel');

});
