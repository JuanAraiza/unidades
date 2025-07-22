<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\TtipovController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\PreciogasController;
use App\Http\Controllers\ProveedorController;
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
Route::resource('operador', OperadorController::class);

Route::resource('unidad', UnidadController::class);


Route::get('/unidad/{unidad}/combustible', [UnidadController::class, 'combustible'])->name('unidad.combustible');
Route::get('/unidad/{unidad}/incidente', [UnidadController::class, 'incidente'])->name('unidad.incidente');
Route::post('/unidad/{unidad}/combustible/gvale', [UnidadController::class, 'guardarvale'])->name('unidad.guardarvale');
Route::post('/unidad/{unidad}/incidente/ginci', [UnidadController::class, 'guardarinci'])->name('unidad.guardarinci');
Route::get('/unidad/{unidad}/incidentes', [UnidadController::class, 'incidentes'])->name('unidad.incidentes');
Route::get('/unidad/{unidad}/recordatorios', [UnidadController::class, 'recordatorios'])->name('unidad.recordatorios');
Route::get('/unidad/{unidad}/operadores', [UnidadController::class, 'operadores'])->name('unidad.operadores');
Route::get('/unidad/{unidad}/estatus', [UnidadController::class, 'estatus'])->name('unidad.estatus');
Route::get('/unidad/{unidad}/documentos', [UnidadController::class, 'documentos'])->name('unidad.documentos');
Route::get('/unidad/{unidad}/imagenes', [UnidadController::class, 'imagenes'])->name('unidad.imagenes');
Route::get('/unidad/{unidad}/imvale', [UnidadController::class, 'imvale'])->name('unidad.imvale');

Route::resource('proveedor', ProveedorController::class);
Route::resource('preciogas', PreciogasController::class);