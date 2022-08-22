<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\WilayahController;

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

Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');

Route::get('wilayah', [WilayahController::class, 'index'])->name('wilayah.index');
Route::post('wilayah', [WilayahController::class, 'store'])->name('wilayah.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

