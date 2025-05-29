<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Abre el formulario de captura de registros
        return view('detalleventa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'cantidad' => 'required',
            'precio_unitario' => 'required',
            
        ]);


        $detalleventa = new DetalleVenta();
        $detalleventa->cantidad = $request->input('cantidad');
        $detalleventa->precio_unitario = $request->input('precio_unitario');
        

        $detalleventa->save();
        return redirect()->route('detalleventas.index')->with(array(
            'message' => 'Se ha agregado el detalle de la venta'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Abre el formulario que permita editar un registro
        $detalleventa = DetalleVenta::findOrFail($id);
        return view('detalleventa.edit', array(
            'detalleventa' => $detalleventa
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Guarda la información del formulario de edición
        $this->validate($request, [
            'cantidad' => 'required',
            'precio_unitrario' => 'required',
            
        ]);

        $detalleventa = DetalleVenta::findOrFail($id);
        $detalleventa->cantidad = $request->input('cantidad');
        $detalleventa->precio_unitario = $request->input('precio_unitario');

        $detalleventa->save();
        return redirect()->route('detalleventas.index')->with(array(
            'message' => 'El detalle de la venta se ha actualizado correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
