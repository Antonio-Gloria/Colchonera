<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
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
        $productos = Producto::where('status', 1)->get();
        return view('producto.index', ['productos' => $this->cargarDT($productos)]);
    }

    private function cargarDT($consulta)
    {
        $productos = [];
        foreach ($consulta as $key => $value) {
            $actualizar = route('productos.edit', $value['id']);
            $acciones = '
           <div class="btn-acciones">
               <div class="btn-circle">
                   <a href="' . $actualizar . '" role="button" class="btn btn-success" title="Actualizar">
                       <i class="far fa-edit"></i>
                   </a>
                    <a role="button" class="btn btn-danger" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal"">
                       <i class="far fa-trash-alt"></i>
                   </a>
               </div>
           </div>';


            $productos[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
                $value['descripcion'],
                $value['precio'],
                $value['tamaño'],
                $value['tela'],
                $value['categoria_id'],
                $value['proveedor_id']
            );
        }
        return $productos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categorias = Categoria::all();
        $proveedors = Proveedor::all();
        //Abre el formulario de captura de registros
        return view('producto.create', compact('categorias', 'proveedors'));

       
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
            'categoria_id'=>'required|exists:categorias,id',
            'proveedor_id'=>'required|exists:proveedors,id',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->tamaño = $request->input('tamaño');
        $producto->tela = $request->input('tela');
        $producto->stock = $request->input('stock');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->proveedor_id = $request->input('proveedor_id');
        $producto->status = 1;

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
        $categorias = Categoria::all();
        $proveedors = Proveedor::all();

        return view('producto.edit', compact('producto', 'categorias', 'proveedors'));
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
            'categoria_id'=>'required|exists:categorias,id',
            'proveedor_id'=>'required|exists:proveedors,id',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->tamaño = $request->input('tamaño');
        $producto->tela = $request->input('tela');
        $producto->stock = $request->input('stock');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->proveedor_id = $request->input('proveedor_id');
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

    public function deleteProducto($producto_id)
    {
        $producto = Producto::find($producto_id);
        if ($producto) {
            $producto->status = 0;
            $producto->update();
            return redirect()->route('productos.index')->with("message", "El producto se ha eliminado correctamente");
        } else {
            return redirect()->route('productos.index')->with("message", "El producto que trata de eliminar no existe");
        }
    }
}
