<?php

namespace App\Http\Controllers;

use App\Models\publicaciones;
use App\Models\Publicaciones as ModelsPublicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones = publicaciones::all();
        return view('publicaciones.index', compact('publicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Publicaciones::create([
                'id_usuario' => Auth::id(),
                'titulo' => $request->titulo,
                'contenido' => $request->contenido
            ]);
            return redirect()->route('publicaciones.index')->with('success', 'Publicación en Linea');
        } catch (\Throwable $th) {
            Log::error('Error al crear la Publicación' . $th->getMessage());
            return redirect()->route('publicaciones.index')->with('error', 'Error al Subir la Publicación');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publicacion = Publicaciones::with('user')->findOrFail($id);
        return view('publicaciones.show', compact('publicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $publicacion = Publicaciones::with('user')->findOrFail($id);

        if ($publicacion->id_usuario !== Auth::id()) {
            return redirect()->route('publicaciones.index')->with('error', 'No tienes permiso.');
        }

        return view('publicaciones.edit', compact('publicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publicacion = Publicaciones::findOrFail($id);

        if ($publicacion->id_usuario !== Auth::id()) {
            return redirect()->route('publicaciones.index')->with('error', 'No tienes permiso para actualizar esta publicacion');
        }

        try {
            $publicacion->update([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido
            ]);

            return redirect()->route('publicaciones.index')->with('success', 'Actualización en Linea');
        } catch (\Throwable $th) {
            Log::error('Error al Actualizar la Publicación' . $th->getMessage());
            return redirect()->route('publicaciones.index')->with('error', 'Error al Actualizar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publicacion = Publicaciones::findOrFail($id);

        if ($publicacion->id_usuario !== Auth::id()) {
            return redirect()->route('publicaciones.index')->with('error', 'No tienes permiso para eliminar esta publicación.');
        }

        try {
            $publicacion->delete();
            return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada');
        } catch (\Throwable $th) {
            Log::error('Error al Eliminar la Publicación: ' . $th->getMessage());
            return redirect()->route('publicaciones.index')->with('error', 'Error al Eliminar');
        }
    }
}
