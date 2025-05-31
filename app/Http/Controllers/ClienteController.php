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
        $clientes = Cliente::where('status', 1)->get();
        return view('cliente.index', ['clientes' => $this->cargarDT($clientes)]);
    }

    private function cargarDT($consulta)
    {
        $clientes = [];
        foreach ($consulta as $key => $value) {
            $actualizar = route('clientes.edit', $value['id']);
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


            $clientes[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
                $value['email'],
                $value['password'],
                $value['direccion'],
                $value['telefono']
            );
        }
        return $clientes;
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
        $cliente->status = 1;
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
        //Abre el formulario que permita editar un registro
        $cliente = Cliente::findOrFail($id);
        return view('cliente.edit', array(
            'cliente' => $cliente
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
            'email' => 'required',
            'password' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->input('nombre');
        $cliente->email = $request->input('email');
        $cliente->password = $request->input('password');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');

        $cliente->save();
        return redirect()->route('clientes.index')->with(array(
            'message' => 'El cliente se ha actualizado correctamente'
        ));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteCliente($cliente_id)
    {
        $cliente = Cliente::find($cliente_id);
        if ($cliente) {
            $cliente->status = 0;
            $cliente->update();
            return redirect()->route('clientes.index')->with("message", "El cliente se ha eliminado correctamente");
        } else {
            return redirect()->route('clientes.index')->with("message", "El cliente que trata de eliminar no existe");
        }
    }
}
