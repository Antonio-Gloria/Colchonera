<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ClienteController extends Controller
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
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'nombre' => 'required|min:5',
            'email' => 'required',
            'password' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',

        ]);


        $cliente = new Cliente();
        $cliente->nombre = $request->input('nombre');
        $cliente->email = $request->input('email');
        $cliente->password = $request->input('password');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        
        $cliente->save();
        return redirect()->route('clientes.index')->with(array(
            'message' => 'La Editorial se ha guardado correctamente'
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
