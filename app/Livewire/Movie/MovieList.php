<?php

namespace App\Livewire\Movie;

use App\Models\Movie;
use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MovieList extends Component
{
    use WithPagination;

    #[On('movie-closed')]
    public function updateClosedMovieList(): void
    {

    }

    public function render()
    {
        $movies = Movie::with(['countries', 'publisher'])->paginate(50);

        return view('livewire.movie.movie-list',['movies' => $movies]);
    }
}
