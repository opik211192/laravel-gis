<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WilayahController;
use App\Models\Wilayah;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/{wilayah}/detail', [WelcomeController::class, 'detail'])->name('welcome.detail');

Auth::routes();

Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');


//Route untuk wilayah
Route::middleware('auth')->prefix('wilayah')->group(function(){
    Route::get('', [WilayahController::class, 'index'])->name('wilayah.index');
    Route::get('/create', [WilayahController::class, 'create'])->name('wilayah.create');
    Route::post('', [WilayahController::class, 'store'])->name('wilayah.store');
    Route::get('/{wilayah}/edit', [WilayahController::class, 'edit'])->name('wilayah.edit');
    Route::put('/{wilayah}/edit', [WilayahController::class, 'update'])->name('wilayah.update');
    Route::delete('/{wilayah}', [WilayahController::class, 'delete'])->name('wilayah.delete');
    Route::get('/{wilayah}/detail', [WilayahController::class, 'show'])->name('wilayah.show');

    Route::get('/data', [WilayahController::class, 'data'])->name('dataAll');
});

//Route Ambil data via ajax
Route::get('data/wilayah', [WilayahController::class, 'getData'])->name('data.wilayah');
Route::get('user/data', [UserController::class, 'index'])->name('user.data');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');


//bikin dulu controller dashboard

