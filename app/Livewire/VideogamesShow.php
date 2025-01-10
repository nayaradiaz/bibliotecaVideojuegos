<?php

namespace App\Livewire;

use App\Models\Videogame;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithFileUploads as LivewireWithFileUploads;

class VideogamesShow extends Component
{
    use LivewireWithFileUploads;
    public $videogames;
    public $photo;
    public $modal = false;
    public $name;
    public $description;
    public $cover;
    public $id;
    public $user_id;
    public $editinggame = null;
    public $users;
    public function render()
    {
        return view('livewire.videogames-show');
    }
    public function mount()
    {
        $this->getGames();
    }
    public function getGames(){
        $this->videogames = Videogame::all();

    }
    public function createVideogame()
    {

        Videogame::Create(
            [
                'name' => $this->name,
                'description' => $this->description,
                'user_id'=>auth()->user()->id,
                ]
        );

        $this->clearFields();
        $this->closeCreateModal();
    }









    public function clearFields()
    {
        $this->name = '';
        $this->description = '';
        $this->cover = '';
    }

    public function openCreateModal(Videogame $game = null)
    {
        if ($game) {
            $this->editinggame = $game;
            $this->name = $game->name;
            $this->description = $game->description;
            $this->id = $game->id;
            $this->cover = $game->cover;
        } else {
            $this->clearFields();
        }
        $this->modal = true;
    }


    public function closeCreateModal()
    {
        $this->modal = false;
    }
    public function save()
    {
        $this->validate([
            'photo' => 'image|max:4024',
        ]);

        $this->photo->store('photos');
    }
}
