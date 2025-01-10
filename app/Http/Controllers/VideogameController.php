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

    


        // Enviar correo al Admin
       // \Mail::to('admin@example.com')->send(new videogameCreado($videogame));

        //return redirect()->route('videogames.index');
    
}
