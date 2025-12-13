<?php

namespace App\Livewire\Movie;

use App\Livewire\Forms\MovieForm;
use App\Livewire\Forms\TaskForm;
use Livewire\Attributes\On;
use Livewire\Component;

class MovieCloseConfirm extends Component
{
    public MovieForm $form;


    #[On('set-movie-id')]
    public function setMovieId($id)
    {

        $this->form->id = $id;
    }


    public function closeMovie()
    {

        $this->form->closeMovie();

        $this->dispatch('movie-closed'); // закрыть модалку
        $this->dispatch('toast',
            type: 'success',
            message: 'Фильм успешно удалён'
        );
    }



    public function render()
    {
        return view('livewire.movie.movie-close-confirm');
    }
}
