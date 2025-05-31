<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedors = Proveedor::where('status', 1)->get();
        return view('proveedor.index', ['proveedors' => $this->cargarDT($proveedors)]);
    }

    private function cargarDT($consulta)
    {
        $proveedors = [];
        foreach ($consulta as $key => $value) {
            $actualizar = route('proveedors.edit', $value['id']);
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


            $proveedors[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
                $value['telefono'],
                $value['email'],
                $value['direccion'],
            );
        }
        return $proveedors;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Abre el formulario de captura de registros
        return view('proveedor.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'nombre' => 'required|min:5',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',

        ]);

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->input('nombre');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->status = 1;
        $proveedor->save();
        return redirect()->route('proveedors.index')->with(array(
            'message' => 'El proveedor se ha guardado correctamente'
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
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedor.edit', array(
            'proveedor' => $proveedor
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
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',

        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre = $request->input('nombre');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->direccion = $request->input('direccion');

        $proveedor->save();
        return redirect()->route('proveedors.index')->with(array(
            'message' => 'El proveedor se ha guardado correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteProveedor($proveedor_id)
    {
        $proveedor = Proveedor::find($proveedor_id);
        if ($proveedor) {
            $proveedor->status = 0;
            $proveedor->update();
            return redirect()->route('proveedors.index')->with("message", "El proveedor se ha eliminado correctamente");
        } else {
            return redirect()->route('proveedors.index')->with("message", "El proveedor que trata de eliminar no existe");
        }
    }
}
