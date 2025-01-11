<?php

namespace App\Livewire;

use App\Models\Videogame;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\NewVideogameNotification;
use Illuminate\Support\Facades\Mail;


class VideogamesShow extends Component
{
    use WithFileUploads;

    public $videogames;
    public $photo;
    public $modalCreate = false; // Modal para crear videojuego
    public $modalDetails = false; // Modal para ver detalles
    public $selectedGame;  // Para almacenar el videojuego seleccionado
    public $name;
    public $description;
    public $cover;

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

        // Crear el videojuego
        $videogame = Videogame::create([
            'name' => $this->name,
            'description' => $this->description,
            'cover' => $coverPath,
            'user_id' => auth()->id(),
        ]);

        Mail::to('nayinformatica1smr.1@gmail.com')->send(new NewVideogameNotification($videogame) );


        $this->clearFields();
        $this->closeCreateModal();
        session()->flash('message', 'Videojuego creado y notificación enviada al administrador.');
    }

    public function openCreateModal()
    {
        $this->clearFields();
        $this->modalCreate = true;
    }

    public function closeCreateModal()
    {
        $this->modalCreate = false;
    }

    public function openGameDetails($gameId)
    {
        $this->selectedGame = Videogame::find($gameId);
        $this->name = $this->selectedGame->name;
        $this->description = $this->selectedGame->description;
        $this->cover = $this->selectedGame->cover;
        $this->modalDetails = true;
    }

    public function closeDetailsModal()
    {
        $this->modalDetails = false;
    }

    public function editGame()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:2048'
        ]);

        // Si hay una nueva imagen, la guardamos, si no usamos la anterior
        $coverPath = $this->photo ? $this->photo->store('covers', 'public') : $this->selectedGame->cover;

        // Actualizamos los detalles del videojuego
        $this->selectedGame->update([
            'name' => $this->name,
            'description' => $this->description,
            'cover' => $coverPath,
        ]);

        session()->flash('message', 'Videojuego actualizado con éxito');
        $this->closeDetailsModal();
        $this->getGames(); // Actualizar la lista de videojuegos
    }

    public function deleteGame()
    {
        // Verificamos si el usuario tiene el rol de admin o es el propietario del videojuego
        if (auth()->user()->hasRole('admin') || $this->selectedGame->user_id == auth()->id()) {
            // Eliminar el videojuego
            $this->selectedGame->delete();
            session()->flash('message', 'Videojuego eliminado con éxito');
            $this->closeDetailsModal();
            $this->getGames(); // Actualizar la lista de videojuegos
        } else {
            // Mensaje de error si el usuario no tiene permisos
            session()->flash('error', 'No tienes permisos para eliminar este videojuego');
        }
    }




    public function clearFields()
    {
        $this->name = '';
        $this->description = '';
        $this->photo = null;
    }
}
