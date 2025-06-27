<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\PdfAssetController;


Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('clientes', App\Http\Controllers\ClienteController::class)->middleware('auth');
Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('detalleventas', App\Http\Controllers\DetalleVentaController::class)->middleware('auth');
Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('proveedors', App\Http\Controllers\ProveedorController::class)->middleware('auth');
Route::resource('reseñas', App\Http\Controllers\ReseñaController::class)->middleware('auth');
Route::resource('ventas', App\Http\Controllers\VentaController::class)->middleware('auth');

Route::get('/delete-proveedor/{proveedor_id}', [
    'as' => 'deleteProveedor',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\ProveedorController@deleteProveedor'
]);
Route::get('/delete-categoria/{categoria_id}', [
    'as' => 'deleteCategoria',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\CategoriaController@deleteCategoria'
]);
Route::get('/delete-cliente/{cliente_id}', [
    'as' => 'deleteCliente',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\ClienteController@deleteCliente'
]);
Route::get('/delete-producto/{producto_id}', [
    'as' => 'deleteProducto',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\ProductoController@deleteProducto'
]);
Route::get('/delete-venta/{venta_id}', [
    'as' => 'deleteVenta',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\VentaController@deleteVenta'
]);
Route::get('/delete-detalleventa/{detalleventa_id}', [
    'as' => 'deleteDetalleVenta',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\DetalleVentaController@deleteDetalleVenta'
]);
Route::get('/delete-reseña/{reseña_id}', [
    'as' => 'deleteReseña',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\DetalleReseñaController@deleteReseña'
]);

Route::get('/icliente',[App\Http\Controllers\GeneradorController::class, 'imprimirCliente'])->name('icliente');
Route::get('/icategoria',[App\Http\Controllers\GeneradorController::class, 'imprimirCategoria'])->name('icategoria');
Route::get('/iproveedor',[App\Http\Controllers\GeneradorController::class, 'imprimirProveedor'])->name('iproveedor');
Route::get('/iproducto',[App\Http\Controllers\GeneradorController::class, 'imprimirProducto'])->name('iproducto');
Route::get('/iventa',[App\Http\Controllers\GeneradorController::class, 'imprimirVenta'])->name('iventa');
Route::get('/idetalleventa',[App\Http\Controllers\GeneradorController::class, 'imprimirDetalleVenta'])->name('idetalleventa');
Route::get('/ireseña',[App\Http\Controllers\GeneradorController::class, 'imprimirReseña'])->name('ireseña');

Route::resource('asset', App\Http\Controllers\AssetController::class)->middleware('auth');
Route::get('/video-file/{filename}', [App\Http\Controllers\AssetController::class, 'getVideo'])->name('fileVideo');

Route::get('/miniatura/{filename}', [App\Http\Controllers\AssetController::class, 'getImage'])->name('imageVideo');

Route::get('/', function () {
    return view('menu'); // muestra la vista pública
});

Route::get('/pdfs', [PdfAssetController::class, 'index'])->name('pdf.index');
Route::get('/pdfs/create', [PdfAssetController::class, 'create'])->name('pdf.create');
Route::post('/pdfs', [PdfAssetController::class, 'store'])->name('pdf.store');
Route::get('/pdfs/{id}', [PdfAssetController::class, 'show'])->name('pdf.show');
Route::get('/pdfs/file/{filename}', [PdfAssetController::class, 'getPdf'])->name('pdf.get');
Route::delete('/pdfs/{id}', [PdfAssetController::class, 'destroy'])->name('pdf.destroy');
