<?php

namespace App\Livewire\Movie;

use App\Models\Movie;
use Livewire\Component;
use Livewire\WithPagination;

class MovieList extends Component
{
    use WithPagination;

    public function render()
    {
        $movies = Movie::with(['countries', 'publisher'])->paginate();
        return view('livewire.movie.movie-list',['movies' => $movies]);
    }
}
