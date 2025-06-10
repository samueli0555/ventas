<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = \App\Models\Usuario::all();
        return Inertia::render('Usuarios/Index', [
            'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        return Inertia::render('Usuarios/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:usuarios',
            'email' => 'required|email|max:255|unique:usuarios',
            'contraseña' => 'required|string|min:6',
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->contraseña = Hash::make($request->contraseña);
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(Usuario $usuario)
    {
        return Inertia::render('Usuarios/Edit', [
            'usuario' => $usuario
        ]);
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:usuarios,usuario,' . $usuario->id,
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id,
            'contraseña' => 'nullable|string|min:6',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        
        if ($request->filled('contraseña')) {
            $usuario->contraseña = Hash::make($request->contraseña);
        }
        
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
} 