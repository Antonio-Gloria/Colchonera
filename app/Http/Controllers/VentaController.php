<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        //Abre el formulario de captura de registros
        return view('venta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'fecha' => 'required',
            'total' => 'required',
            'estado' => 'required',
        ]);

        $venta = new Venta();
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->estado = $request->input('estado');

        $venta->save();
        return redirect()->route('proveedors.index')->with(array(
            'message' => 'La venta se ha guardado correctamente'
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
        $venta = Venta::findOrFail($id);
        return view('venta.edit', array(
            'venta' => $venta
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'fecha' => 'required',
            'total' => 'required',
            'estado' => 'required',
        ]);

        $venta = new Venta();
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->estado = $request->input('estado');

        $venta->save();
        return redirect()->route('proveedors.index')->with(array(
            'message' => 'La venta se ha guardado correctamente'
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
