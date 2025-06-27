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

Route::middleware([])->group(function () {
    Route::resource('sales-income', \App\Http\Controllers\SalesIncomePdfController::class)
        ->except(['destroy'])
        ->names([
            'index' => 'sales-income.index',
            'create' => 'sales-income.create',
            'store' => 'sales-income.store',
            'show' => 'sales-income.show',
            'edit' => 'sales-income.edit',
            'update' => 'sales-income.update'
        ]);

    Route::get('sales-income/{salesIncome}/download', [\App\Http\Controllers\SalesIncomePdfController::class, 'download'])
        ->name('sales-income.download');

    Route::delete('sales-income/{salesIncome}', [\App\Http\Controllers\SalesIncomePdfController::class, 'destroy'])
        ->name('sales-income.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('financial-documents', \App\Http\Controllers\FinancialDocumentController::class);
    Route::get('financial-documents/type/{type}', [\App\Http\Controllers\FinancialDocumentController::class, 'byType'])
         ->name('financial-documents.type');
    // Add the download route
    Route::get('financial-documents/download/{id}', [\App\Http\Controllers\FinancialDocumentController::class, 'download'])
         ->name('financial-documents.download');
});