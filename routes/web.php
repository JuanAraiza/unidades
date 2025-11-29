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
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/inicio', function () {
    return view('inicio');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::resource('tipov', TtipovController::class)->middleware('admin');

Route::resource('dependencia', DependenciaController::class)->middleware('admin');
Route::post('/dependencia/addArea', [DependenciaController::class, 'addArea'])->name('dependencia.addArea')->middleware('admin');
Route::post('/dependencia/destroyArea', [DependenciaController::class, 'destroyArea'])->name('dependencia.destroyArea')->middleware('admin');
Route::resource('area', AreaController::class)->middleware('admin');
Route::resource('responsable', ResponsableController::class)->middleware('admin');
Route::resource('operador', OperadorController::class)->middleware('admin');

Route::resource('unidad', UnidadController::class);

Route::resource('usuarios', UsuariosController::class)->middleware('admin');



Route::get('/unidad/{unidad}/combustible', [UnidadController::class, 'combustible'])->name('unidad.combustible');
Route::get('/unidad/{unidad}/bitacora', [UnidadController::class, 'bitacora'])->name('unidad.bitacora');
Route::get('/unidad/{unidad}/incidente', [UnidadController::class, 'incidente'])->name('unidad.incidente');
Route::get('/unidad/{unidad}/imagenes', [UnidadController::class, 'imagenes'])->name('unidad.imagenes');
Route::get('/unidad/{unidad}/estatus', [UnidadController::class, 'estatus'])->name('unidad.estatus');
Route::get('/unidad/{unidad}/operadores', [UnidadController::class, 'operadores'])->name('unidad.operadores');
Route::get('/unidad/{unidad}/recordatorios', [UnidadController::class, 'recordatorios'])->name('unidad.recordatorios');
Route::post('/unidad/{unidad}/combustible/gvale', [UnidadController::class, 'guardarvale'])->name('unidad.guardarvale');
Route::post('/unidad/{unidad}/incidente/ginci', [UnidadController::class, 'guardarinci'])->name('unidad.guardarinci');
Route::post('/unidad/{unidad}/bitacora/gbita', [UnidadController::class, 'guardarbita'])->name('unidad.guardarbita');
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

Route::delete('/unidad/{unidad}/incidente/destroy', [UnidadController::class, 'distroyIncidente'])->name('incidente.destroyIncidente')->middleware('admin');
Route::delete('/unidad/{unidad}/bitacora/destroy', [UnidadController::class, 'destroyBitacora'])->name('bitacora.destroyBitacora')->middleware('admin');
Route::post('/unidad/{unidad}/incidente/edit', [UnidadController::class, 'editIncidente'])->name('incidente.editIncidente');
Route::post('/unidad/{unidad}/incidente/update', [UnidadController::class, 'updateIncidente'])->name('incidente.updateIncidente');
Route::post('/unidad/{unidad}/incidente/cerrar', [UnidadController::class, 'cerrarIncidente'])->name('incidente.cerrarIncidente')->middleware('admin');
Route::post('/unidad/{unidad}/recordatorios/cerrar', [UnidadController::class, 'cerrarRecordatorio'])->name('recordatorios.cerrarRecordatorio')->middleware('admin');
Route::delete('/unidad/{unidad}/imagenes/distroy', [UnidadController::class, 'distroyImagen'])->name('imagenesu.destroyImagen')->middleware('admin');
Route::delete('/unidad/{unidad}/documentos/distroy', [UnidadController::class, 'distroyDocumento'])->name('documentosu.distroyDocumento')->middleware('admin');
Route::delete('/unidad/{unidad}/estatus/distroy', [UnidadController::class, 'distroyEstatus'])->name('estatus.distroyEstatus')->middleware('admin');
Route::delete('/unidad/{unidad}/recordatorios/distroy', [UnidadController::class, 'distroyRecordatorio'])->name('recordatorios.distroyRecordatorio')->middleware('admin');
Route::delete('/unidad/{unidad}/operadores/distroy', [UnidadController::class, 'distroyOperador'])->name('operadores.distroyOperador')->middleware('admin');
Route::post('/unidad/{unidad}/bitacora/edit', [UnidadController::class, 'editBitacora'])->name('bitacora.editIncidente');
Route::post('/unidad/{unidad}/bitacora/update', [UnidadController::class, 'updateBitacora'])->name('bitacora.updateIncidente');

Route::resource('proveedor', ProveedorController::class)->middleware('admin');
Route::resource('preciogas', PreciogasController::class)->middleware('admin');


Route::resource('combustible', CombustibleController::class)->middleware('admin');
Route::put('/combustible/{vale}/validar', [CombustibleController::class, 'validar'])->name('combustible.validar')->middleware('admin');
Route::put('/combustible/{vale}/cancelar', [CombustibleController::class, 'cancelar'])->name('combustible.cancelar')->middleware('admin');

Route::get('/valesvalidados', [CombustibleController::class, 'validados'])->name('combustible.validados')->middleware('admin');
Route::put('/combustible/{vale}/cancelarValidados', [CombustibleController::class, 'cancelarValidados'])->name('combustible.cancelarValidados')->middleware('admin');
Route::get('/combustible/{unidad}/imvale', [CombustibleController::class, 'imvale'])->name('combustible.imvale')->middleware('admin');

Route::get('/vervale/{vale}', [CombustibleController::class, 'show'])->name('combustible.show');
Route::get('/cargarvale/{vale}', [CombustibleController::class, 'cargarvale'])->name('combustible.cargarvale');
Route::post('/cargarvaledos/{vale}', [CombustibleController::class, 'cargarvaledos'])->name('combustible.cargarvaledos');
Route::post('/crearfactura', [CombustibleController::class, 'crearfactura'])->name('combustible.crearFactura');


Route::post('/combustible/paracargar', [CombustibleController::class, 'paracargar'])->name('combustible.paracargar')->middleware('admin');
Route::post('/combustible/cargados', [CombustibleController::class, 'cargados'])->name('combustible.cargados')->middleware('admin');
Route::post('/combustible/pagogas', [CombustibleController::class, 'pagogas'])->name('combustible.pagogas')->middleware('admin');
Route::post('/combustible/nuevoofi', [CombustibleController::class, 'nuevoofi'])->name('combustible.nuevoofi')->middleware('admin');
Route::post('/combustible/oficios', [CombustibleController::class, 'oficios'])->name('combustible.oficios')->middleware('admin');
Route::get('/cancelados', [CombustibleController::class, 'cancelados'])->name('combustible.cancelados')->middleware('admin');
Route::post('/combustible/todos', [CombustibleController::class, 'todos'])->name('combustible.todos')->middleware('admin');
Route::get('/comprometidos', [CombustibleController::class, 'comprometidos'])->name('combustible.comprometidos')->middleware('admin');
Route::post('/crearFactura', [CombustibleController::class, 'crearFactura'])->name('combustible.crearFactura')->middleware('admin');
Route::get('/formalizado', [CombustibleController::class, 'formalizado'])->name('combustible.formalizado')->middleware('admin');

Route::post('combustible/{tramite}/addFacturaCom', [CombustibleController::class, 'addFacturaCom'])->name('combustible.addFacturaCom')->middleware('admin');
Route::put('combustible/{tramite}/changeFactura', [CombustibleController::class, 'changeFactura'])->name('combustible.changeFactura')->middleware('admin');
Route::get('/exportFoliosExcel/{tramite}', [CombustibleController::class, 'exportFoliosExcel'])->name('combustible.exportFoliosExcel')->middleware('admin');
Route::delete('/destroyFactura/{tramite}', [CombustibleController::class, 'destroyFactura'])->name('combustible.destroyFactura')->middleware('admin');
Route::get('/descargarWord/{tramite}', [CombustibleController::class, 'descargarWord'])->name('combustible.descargarWord')->middleware('admin');
Route::get('/actualizarFolios/{tramite}', [CombustibleController::class, 'actualizarFolios'])->name('combustible.actualizarFolios')->middleware('admin');
Route::get('/completados', [CombustibleController::class, 'completados'])->name('combustible.completados')->middleware('admin');