<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ReseñaController extends Controller
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
        return view('reseña.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'comentario' => 'required',
            'calificacion' => 'required',
        ]);

        $reseña = new reseña();
        $reseña->comentario = $request->input('comentario');
        $reseña->calificacion = $request->input('calificacion');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Abre el formulario que permita editar un registro
        $reseña = Reseña::findOrFail($id);
        return view('reseña.edit', array(
            'reseña' => $reseña
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'comentario' => 'required',
            'calificacion' => 'required',
        ]);

        $reseña = new reseña();
        $reseña->comentario = $request->input('comentario');
        $reseña->calificacion = $request->input('calificacion');

        $reseña->save();
        return redirect()->route('reseñas.index')->with(array(
            'message' => 'La modificación de la reseña se ha guardado correctamente'
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
