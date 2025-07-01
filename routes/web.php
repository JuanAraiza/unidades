<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\TtipovController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\UnidadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/inicio', function () {
    return view('inicio');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('tipov', TtipovController::class);

Route::resource('dependencia', DependenciaController::class);
Route::resource('area', AreaController::class);
Route::resource('responsable', ResponsableController::class);
Route::resource('unidad', UnidadController::class);
