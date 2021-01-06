<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguimientoController;

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

Route::middleware(['guest:' . config('admin-auth.defaults.guard')])->group(function () {
	Route::get('/', function () {
	    return view('auth.login');
	});
});

Auth::routes();

Route::middleware(['auth:' . config('admin-auth.defaults.guard')])->group(function () {
	Route::get('/home', [App\Http\Controllers\SeguimientoController::class, 'index'])->name('home');

	//Route::resource('seguimiento', SeguimientoController::class);
	Route::get('/seguimiento', [App\Http\Controllers\SeguimientoController::class, 'index'])->name('seguimiento.index');
	Route::post('/seguimiento', [App\Http\Controllers\SeguimientoController::class, 'store'])->name('seguimiento.index');
	Route::post('/seguimiento/update', [App\Http\Controllers\SeguimientoController::class, 'update'])->name('seguimiento.update');
	Route::get('/busqueda', [App\Http\Controllers\SeguimientoController::class, 'search'])->name('search.index');
	Route::post('/busqueda', [App\Http\Controllers\SeguimientoController::class, 'show'])->name('search');
});