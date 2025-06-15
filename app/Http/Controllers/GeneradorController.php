<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Categoria;

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
}
