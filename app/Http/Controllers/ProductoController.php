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
            'stock' => 'required',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->tamanio = $request->input('tamanio');
        $producto->tela = $request->input('tela');
        $producto->stock = $request->input('stock');

        $producto->save();
        return redirect()->route('productos.index')->with(array(
            'message' => 'El producto se ha guardado correctamente'
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
        $producto = Producto::findOrFail($id);
        return view('producto.edit', array(
            'producto' => $producto
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'nombre' => 'required|min:5',
            'descripcion' => 'required',
            'precio' => 'required',
            'tamaño' => 'required',
            'tela' => 'required',
            'stock' => 'required',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->tamanio = $request->input('tamanio');
        $producto->tela = $request->input('tela');
        $producto->stock = $request->input('stock');

        $producto->save();
        return redirect()->route('productos.index')->with(array(
            'message' => 'El producto se ha actualizado correctamente'
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
