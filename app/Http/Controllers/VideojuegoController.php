<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;

class VideojuegoController extends Controller
{
    public function index()
    {
        $videojuegos = Videojuego::all();
        return view('videojuegos.index', compact('videojuegos'));
    }

    public function create()
    {
        return view('videojuegos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'caratula' => 'image|nullable',
        ]);

        $videojuego = new Videojuego();
        $videojuego->nombre = $request->nombre;
        $videojuego->descripcion = $request->descripcion;
        $videojuego->user_id = auth()->id();

        if ($request->hasFile('caratula')) {
            $path = $request->file('caratula')->store('caratulas', 'public');
            $videojuego->caratula = $path;
        }

        $videojuego->save();

        // Enviar correo al Admin
        \Mail::to('admin@example.com')->send(new VideojuegoCreado($videojuego));

        return redirect()->route('videojuegos.index');
    }
}
