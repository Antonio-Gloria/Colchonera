<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
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
   return view('producto.create');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
//validación de campos requeridos
$this->validate($request, [
   'nombre' => 'required|min:5',
   'descripcion' => 'required',
   'precio' => 'required',
   'tamaño' => 'required',
   'tela' => 'required',
   
]);


$producto = new Producto();
$producto->nombre = $request->input('nombre');
$producto->domicilio = $request->input('domicilio');
$producto->correo = $request->input('correo');
$producto->status = 1;
$producto->save();
return redirect()->route('productos.index')->with(array(
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
