<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::where('status', 1)->get();
        return view('categoria.index', ['categorias' => $this->cargarDT($categorias)]);
    }

    private function cargarDT($consulta)
    {
        $categorias = [];
        foreach ($consulta as $key => $value) {
            $actualizar = route('categorias.edit', $value['id']);
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


            $categorias[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
            );
        }
        return $categorias;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'nombre' => 'required|min:5',


        ]);


        $categoria = new Categoria();
        $categoria->nombre = $request->input('nombre');
        $categoria->status = 1;
        $categoria->save();
        return redirect()->route('categorias.index')->with(array(
            'message' => 'La nueva categoria se ha guardado correctamente'
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
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit', array(
            'categoria' => $categoria
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Guarda la información del formulario de edición
        $this->validate($request, [
            'nombre' => 'required|min:5',
            
        ]);
        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->input('nombre');
        $categoria->save();
        return redirect()->route('categorias.index')->with(array(
            'message' => 'La categoria se ha actualizado correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteCategoria($proveedor_id)
    {
        $categoria = Categoria::find($proveedor_id);
        if ($categoria) {
            $categoria->status = 0;
            $categoria->update();
            return redirect()->route('categorias.index')->with("message", "La categoria se ha eliminado correctamente");
        } else {
            return redirect()->route('categorias.index')->with("message", "La categoria que trata de eliminar no existe");
        }
    }
}
