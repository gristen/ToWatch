<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class DeleteFavoritesMovie extends Component
{

    public UserForm $form;



    public function deleteFavoritesMovies()
    {

        $this->dispatch('movie-deleted');
    }

    public function render()
    {
        return view('livewire.delete-favorites-movie');
    }
}
