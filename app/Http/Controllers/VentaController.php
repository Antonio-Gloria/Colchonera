<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::where('status', 1)->get();
        return view('venta.index', ['ventas' => $this->cargarDT($ventas)]);
    }

    private function cargarDT($consulta)
    {
        $ventas = [];
        foreach ($consulta as $key => $value) {
            $actualizar = route('ventas.edit', $value['id']);
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


            $ventas[$key] = array(
                $acciones,
                $value['id'],
                $value->cliente->nombre ?? 'Sin nombre',
                $value['fecha'],
                $value['total'],
                $value['estado'],
            );
        }
        return $ventas;
    }
    public function create()
    {
        //Abre el formulario de captura de registros
        $clientes = Cliente::all();
        return view('venta.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required',
            'total' => 'required',
            'estado' => 'required',
        ]);

        $venta = new Venta();
        $venta->cliente_id = $request->input('cliente_id');
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->estado = $request->input('estado');
        $venta->status = 1;
        $venta->save();
        return redirect()->route('ventas.index')->with(array(
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
        $clientes = Cliente::all();
        return view('venta.edit', compact('venta', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required',
            'total' => 'required',
            'estado' => 'required',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->cliente_id = $request->input('cliente_id');
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->estado = $request->input('estado');
        $venta->save();
        return redirect()->route('ventas.index')->with(array(
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

    public function deleteVenta($venta_id)
    {
        $venta = Venta::find($venta_id);
        if ($venta) {
            $venta->status = 0;
            $venta->update();
            return redirect()->route('ventas.index')->with("message", "El venta se ha eliminado correctamente");
        } else {
            return redirect()->route('ventas.index')->with("message", "El venta que trata de eliminar no existe");
        }
    }
}
