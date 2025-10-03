<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CombustibleController;
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
Route::get('/unidad/{unidad}/imagenes', [UnidadController::class, 'imagenes'])->name('unidad.imagenes');
Route::get('/unidad/{unidad}/estatus', [UnidadController::class, 'estatus'])->name('unidad.estatus');
Route::get('/unidad/{unidad}/operadores', [UnidadController::class, 'operadores'])->name('unidad.operadores');
Route::get('/unidad/{unidad}/recordatorios', [UnidadController::class, 'recordatorios'])->name('unidad.recordatorios');
Route::post('/unidad/{unidad}/combustible/gvale', [UnidadController::class, 'guardarvale'])->name('unidad.guardarvale');
Route::post('/unidad/{unidad}/incidente/ginci', [UnidadController::class, 'guardarinci'])->name('unidad.guardarinci');
Route::post('/unidad/{unidad}/imagenes/gimagen', [UnidadController::class, 'guardarimagenu'])->name('unidad.guardarimagen');
Route::post('/unidad/{unidad}/documentos/gdocu', [UnidadController::class, 'guardarDocumento'])->name('unidad.guardarDocumento');
Route::post('/unidad/{unidad}/estatus/gestatus', [UnidadController::class, 'guardarEstatus'])->name('unidad.guardarEstatus');
Route::post('/unidad/{unidad}/recordatorios/grecordatorio', [UnidadController::class, 'guardarRecordatorio'])->name('unidad.guardarRecordatorio');
Route::post('/unidad/{unidad}/operadores/goperador', [UnidadController::class, 'guardarOperador'])->name('unidad.guardarOperador');
//Route::get('/unidad/{unidad}/incidentes', [UnidadController::class, 'incidentes'])->name('unidad.incidentes');
Route::get('/unidad/{unidad}/recordatorios', [UnidadController::class, 'recordatorios'])->name('unidad.recordatorios');
Route::get('/unidad/{unidad}/operadores', [UnidadController::class, 'operadores'])->name('unidad.operadores');
Route::get('/unidad/{unidad}/estatus', [UnidadController::class, 'estatus'])->name('unidad.estatus');
Route::get('/unidad/{unidad}/documentos', [UnidadController::class, 'documentos'])->name('unidad.documentos');
Route::get('/unidad/{unidad}/imagenes', [UnidadController::class, 'imagenes'])->name('unidad.imagenes');
Route::get('/unidad/{unidad}/imvale', [UnidadController::class, 'imvale'])->name('unidad.imvale');

Route::delete('/unidad/{unidad}/incidente/destroy', [UnidadController::class, 'distroyIncidente'])->name('incidente.destroyIncidente');
Route::post('/unidad/{unidad}/incidente/edit', [UnidadController::class, 'editIncidente'])->name('incidente.editIncidente');
Route::post('/unidad/{unidad}/incidente/update', [UnidadController::class, 'updateIncidente'])->name('incidente.updateIncidente');
Route::post('/unidad/{unidad}/incidente/cerrar', [UnidadController::class, 'cerrarIncidente'])->name('incidente.cerrarIncidente');
Route::post('/unidad/{unidad}/recordatorios/cerrar', [UnidadController::class, 'cerrarRecordatorio'])->name('recordatorios.cerrarRecordatorio');
Route::delete('/unidad/{unidad}/imagenes/distroy', [UnidadController::class, 'distroyImagen'])->name('imagenesu.destroyImagen');
Route::delete('/unidad/{unidad}/documentos/distroy', [UnidadController::class, 'distroyDocumento'])->name('documentosu.distroyDocumento');
Route::delete('/unidad/{unidad}/estatus/distroy', [UnidadController::class, 'distroyEstatus'])->name('estatus.distroyEstatus');
Route::delete('/unidad/{unidad}/recordatorios/distroy', [UnidadController::class, 'distroyRecordatorio'])->name('recordatorios.distroyRecordatorio');
Route::delete('/unidad/{unidad}/operadores/distroy', [UnidadController::class, 'distroyOperador'])->name('operadores.distroyOperador');
Route::resource('proveedor', ProveedorController::class);
Route::resource('preciogas', PreciogasController::class);


Route::resource('combustible', CombustibleController::class);
Route::put('/combustible/{vale}/validar', [CombustibleController::class, 'validar'])->name('combustible.validar');
Route::put('/combustible/{vale}/cancelar', [CombustibleController::class, 'cancelar'])->name('combustible.cancelar');

Route::get('/valesvalidados', [CombustibleController::class, 'validados'])->name('combustible.validados');
Route::put('/combustible/{vale}/cancelarValidados', [CombustibleController::class, 'cancelarValidados'])->name('combustible.cancelarValidados');
Route::get('/combustible/{unidad}/imvale', [CombustibleController::class, 'imvale'])->name('combustible.imvale');

Route::get('/vervale/{vale}', [CombustibleController::class, 'show'])->name('combustible.show');

Route::post('/combustible/paracargar', [CombustibleController::class, 'paracargar'])->name('combustible.paracargar');
Route::post('/combustible/cargados', [CombustibleController::class, 'cargados'])->name('combustible.cargados');
Route::post('/combustible/pagogas', [CombustibleController::class, 'pagogas'])->name('combustible.pagogas');
Route::post('/combustible/nuevoofi', [CombustibleController::class, 'nuevoofi'])->name('combustible.nuevoofi');
Route::post('/combustible/oficios', [CombustibleController::class, 'oficios'])->name('combustible.oficios');
Route::post('/combustible/cancelados', [CombustibleController::class, 'cancelados'])->name('combustible.cancelados');
Route::post('/combustible/todos', [CombustibleController::class, 'todos'])->name('combustible.todos');