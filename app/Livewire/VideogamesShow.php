<?php

namespace App\Livewire;

use App\Models\Videogame;
use Livewire\Component;

class VideogamesShow extends Component
{
    public function render()
    {
        return view('livewire.videogames-show');
    }
    public $videogames;
    public function index()
    {
        $this->videogames = Videogame::all();
    }
}
