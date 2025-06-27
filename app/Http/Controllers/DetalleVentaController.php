<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Producto;
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
        $detalleventas = DetalleVenta::where('status', 1)->get();
        return view('detalleventa.index', ['detalleventas' => $this->cargarDT($detalleventas)]);
    }

    private function cargarDT($consulta)
    {
        $detalleventas = [];
        foreach ($consulta as $key => $value) {
            $actualizar = route('detalleventas.edit', $value['id']);
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


            $detalleventas[$key] = array(
                $acciones,
                $value['id'],
                $value['venta_id'],
                $value->producto->nombre ?? 'Sin nombre',
                $value['cantidad'],
                $value['precio_unitario'],
            );
        }
        return $detalleventas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Abre el formulario de captura de registros
        $ventas = Venta::all();
        $productos = Producto::all();
        return view('detalleventa.create', compact('ventas', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required',
            'precio_unitario' => 'required',
        ]);

        $detalleventa = new DetalleVenta();
        $detalleventa->venta_id = $request->input('venta_id');
        $detalleventa->producto_id = $request->input('producto_id');
        $detalleventa->cantidad = $request->input('cantidad');
        $detalleventa->precio_unitario = $request->input('precio_unitario');
        $detalleventa->status = 1;
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
        $ventas = Venta::all();
        $productos = Producto::all();
        return view('detalleventa.edit', compact('detalleventa', 'ventas', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Guarda la información del formulario de edición
        $this->validate($request, [
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required',
            'precio_unitario' => 'required',

        ]);

        $detalleventa = DetalleVenta::findOrFail($id);
        $detalleventa->venta_id = $request->input('venta_id');
        $detalleventa->producto_id = $request->input('producto_id');
        $detalleventa->cantidad = $request->input('cantidad');
        $detalleventa->precio_unitario = $request->input('precio_unitario');
        $detalleventa->status = 1;
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

    public function deleteDetalleVenta($detalleventa_id)
    {
        $detalleventa = DetalleVenta::find($detalleventa_id);
        if ($detalleventa) {
            $detalleventa->status = 0;
            $detalleventa->update();
            return redirect()->route('detalleventas.index')->with("message", "El detalle de la venta se ha eliminado correctamente");
        } else {
            return redirect()->route('detalleventas.index')->with("message", "El detalle de la venta que trata de eliminar no existe");
        }
    }
}
