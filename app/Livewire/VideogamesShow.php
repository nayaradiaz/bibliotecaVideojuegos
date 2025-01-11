<?php

namespace App\Livewire;

use App\Models\Videogame;
use Livewire\Component;
use Livewire\WithFileUploads;

class VideogamesShow extends Component
{
    use WithFileUploads;

    public $videogames;
    public $photo;
    public $modal = false;
    public $name;
    public $description;
    public $cover;
    public $editinggame = null;

    public function render()
    {
        return view('livewire.videogames-show');
    }

    public function mount()
    {
        $this->getGames();
    }

    public function getGames()
    {
        $this->videogames = Videogame::all();
    }

    public function createVideogame()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:2048'
        ]);

        // Guardar imagen si existe
        $coverPath = $this->photo ? $this->photo->store('covers', 'public') : 'images/default_cover.jpg';

        Videogame::create([
            'name' => $this->name,
            'description' => $this->description,
            'cover' => $coverPath,
            'user_id' => auth()->id(),
        ]);

        $this->clearFields();
        $this->closeCreateModal();
    }

    public function clearFields()
    {
        $this->name = '';
        $this->description = '';
        $this->photo = null;
    }

    public function openCreateModal()
    {
        $this->clearFields();
        $this->modal = true;
    }

    public function closeCreateModal()
    {
        $this->modal = false;
    }
}
