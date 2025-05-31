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