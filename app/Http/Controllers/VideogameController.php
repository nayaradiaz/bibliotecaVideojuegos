<?php

namespace App\Http\Controllers;

use App\Models\Videogame;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    public function index()
    {
        $videogames = Videogame::all();
        return view('dashboard', compact('videogames'));
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'cover' => 'image|nullable',
        ]);

        $videogame = new Videogame();
        $videogame->name = $request->name;
        $videogame->description = $request->description;

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('cover', 'public');
            $videogame->cover = $path;
        }

        $videogame->save();

        // Enviar correo al Admin
       // \Mail::to('admin@example.com')->send(new videogameCreado($videogame));

        //return redirect()->route('videogames.index');
    }
}
