<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReseñaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Requiere autenticación para todos los métodos
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reseñas = Reseña::active()->with(['producto', 'cliente'])->get();
        return view('reseña.index', compact('reseñas'));
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

        if (Auth::id() !== $request->input('cliente_id')) {
            abort(403, 'Acción no autorizada.');
        }

        $reseña = new Reseña();
        $reseña->comentario = $request->input('comentario');
        $reseña->calificacion = $request->input('calificacion');
        $reseña->producto_id = $request->input('producto_id');
        $reseña->cliente_id = $request->input('cliente_id');
        $reseña->status = 1; // Activo por defecto
        $reseña->save();

        return redirect()->route('reseñas.index')->with('message', 'La reseña se ha guardado correctamente');
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
        $reseña = Reseña::active()->findOrFail($id);
        $productos = Producto::all();
        $clientes = Cliente::all();

        if (Auth::id() !== $reseña->cliente_id) {
            abort(403, 'Acción no autorizada.');
        }

        return view('reseña.edit', compact('reseña', 'productos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'comentario' => 'required|string|max:1000',
            'calificacion' => 'required|integer|min:1|max:5',
            'producto_id' => 'required|exists:productos,id',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $reseña = Reseña::active()->findOrFail($id);

        if (Auth::id() !== $reseña->cliente_id) {
            abort(403, 'Acción no autorizada.');
        }

        $reseña->comentario = $request->input('comentario');
        $reseña->calificacion = $request->input('calificacion');
        $reseña->producto_id = $request->input('producto_id');
        $reseña->cliente_id = $request->input('cliente_id');
        $reseña->save();

        return redirect()->route('reseñas.index')->with('message', 'La modificación de la reseña se ha guardado correctamente');
    }

    /**
     * Remove the specified resource from storage (logical delete).
     */
    public function destroy(string $id)
    {
        $reseña = Reseña::active()->findOrFail($id);

        if (Auth::id() !== $reseña->cliente_id) {
            abort(403, 'Acción no autorizada.');
        }

        $reseña->update(['status' => 2]); // Borrado lógico

        return redirect()->route('reseñas.index')->with('message', 'La reseña se ha eliminado correctamente');
    }
}