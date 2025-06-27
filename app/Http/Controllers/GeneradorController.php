<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Reseña;

class GeneradorController extends Controller
{


    public function imprimirCliente()
    {
        $clientes = Cliente::WHERE('status', '1')->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadview('icliente', compact('clientes'));
        return $pdf->download('icliente.pdf');
    }

    public function imprimirCategoria()
    {
        $categorias = Categoria::WHERE('status', '1')->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadview('icategoria', compact('categorias'));
        return $pdf->download('icategoria.pdf');
    } 

    public function imprimirProveedor()
    {
        $proveedores = Proveedor::WHERE('status', '1')->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadview('iproveedor', compact('proveedores'));
        return $pdf->download('iproveedor.pdf');
    } 

    public function imprimirProducto()
    {
        $productos = Producto::WHERE('status', '1')->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadview('iproducto', compact('productos'));
        return $pdf->download('iproducto.pdf');
    } 

    public function imprimirVenta()
    {
        $ventas = Venta::WHERE('status', '1')->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadview('iventa', compact('ventas'));
        return $pdf->download('iventa.pdf');
    } 

    public function imprimirDetalleVenta()
    {
        $detalleventas = DetalleVenta::WHERE('status', '1')->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadview('idetalleventa', compact('detalleventas'));
        return $pdf->download('idetalleventa.pdf');
    } 

    public function imprimirReseña()
    {
        $reseñas = Reseña::WHERE('status', '1')->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadview('ireseña', compact('reseñas'));
        return $pdf->download('ireseña.pdf');
    } 
}
