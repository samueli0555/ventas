<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Categorias/Index', [
            'categorias' => Categoria::paginate(10)
        ]);
    }

    /**
     * muestra la listado de cstegorias
     */
    public function create()
    {
        return Inertia::render('Categorias/Create');
    }

    /**
     * muestra el formulario para crear nueva categoria
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente');
    }

    /**
     * muestra la informacion de una categoria especifico
     */
    public function show(Categoria $categoria)
    {
        return Inertia::render('Categorias/Show', [
            'categoria' => $categoria->load('productos')
        ]);
    }

    /**
     * muetsra el formulario para editar una categoria
     */
    public function edit(Categoria $categoria)
    {
        return Inertia::render('Categorias/Edit', [
            'categoria' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente');
    }

    //devuelve todas las categorias con sus producto con sus productos asociados (API)
    public function categoriaConproducto(){
        $categoria=\App\Models\Categoria::with('productos')->get();
        return response()->json($categoria);
    }
}
