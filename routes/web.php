<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/icliente',[App\Http\Controllers\GeneradorController::class, 'imprimirCliente'])->name('icliente');
Route::get('/icategoria',[App\Http\Controllers\GeneradorController::class, 'imprimirCategoria'])->name('icategoria');
Route::get('/iproveedor',[App\Http\Controllers\GeneradorController::class, 'imprimirProveedor'])->name('iproveedor');
Route::get('/iproducto',[App\Http\Controllers\GeneradorController::class, 'imprimirProducto'])->name('iproducto');
Route::get('/iproveedor',[App\Http\Controllers\GeneradorController::class, 'imprimirProveedor'])->name('iproveedor');
Route::get('/iproveedor',[App\Http\Controllers\GeneradorController::class, 'imprimirProveedor'])->name('iproveedor');
Route::get('/iproveedor',[App\Http\Controllers\GeneradorController::class, 'imprimirProveedor'])->name('iproveedor');