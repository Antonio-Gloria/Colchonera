<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReseñaController extends Controller
{

    public function index()
    {
        $reseñas = Reseña::where('status', 1)->get();
        return view('reseña.index', ['reseñas' => $this->cargarDT($reseñas)]);

    }

    private function cargarDT($reseña)
    {
        $reseñas = [];
        foreach ($reseña as $key => $value) {
            $actualizar = route('reseñas.edit', $value['id']);
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


            $reseñas[$key] = array(
                $acciones,
                $value['id'],
                $value->producto->nombre ?? 'Sin nombre',
                $value->cliente->nombre ?? 'Sin nombre',
                $value['comentario'],
                $value['calificacion'],
            );
        }
        return $reseñas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        return view('reseña.create', compact('productos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'comentario' => 'required|string|max:1000',
            'calificacion' => 'required|integer|min:1|max:5',
            'producto_id' => 'required|exists:productos,id',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $reseña = new Reseña();
        $reseña->producto_id = $request->input('producto_id');
        $reseña->cliente_id = $request->input('cliente_id');
        $reseña->comentario = $request->input('comentario');
        $reseña->calificacion = $request->input('calificacion');
        $reseña->status = 1; // Activo por defecto
        $reseña->save();

        return redirect()->route('reseñas.index')->with(array(
            'message' => 'La reseña se ha guardado correctamente'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reseña = Reseña::active()->with(['producto', 'cliente'])->findOrFail($id);
        return view('reseña.show', compact('reseña'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reseña = Reseña::findOrFail($id);
        $productos = Producto::all();
        $clientes = Cliente::all();
        return view('reseña.edit', compact('reseña', 'productos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'producto_id' => 'required|exists:productos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'comentario' => 'required|string|max:1000',
            'calificacion' => 'required|integer|min:1|max:5',
            
        ]);

        $reseña = Reseña::  findOrFail($id);
        $reseña->producto_id = $request->input('producto_id');
        $reseña->cliente_id = $request->input('cliente_id');
        $reseña->comentario = $request->input('comentario');
        $reseña->calificacion = $request->input('calificacion');
        $reseña->save();

        return redirect()->route('reseñas.index')->with('message', 'La modificación de la reseña se ha guardado correctamente');
    }

    /**
     * Remove the specified resource from storage (logical delete).
     */
    public function destroy(string $id)
    {
           }

           public function deleteReseña($reseña_id)
    {
        $reseña = Reseña::find($reseña_id);
        if ($reseña) {
            $reseña->status = 0;
            $reseña->update();
            return redirect()->route('reseñas.index')->with("message", "La reseña se ha eliminado correctamente");
        } else {
            return redirect()->route('reseñas.index')->with("message", "La reseña que trata de eliminar no existe");
        }
    }
}