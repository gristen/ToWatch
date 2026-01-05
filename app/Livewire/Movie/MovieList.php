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

    public string $type = 'all';


    public function render()
    {

        $query = Movie::with(['countries', 'publisher'])->orderByDesc('imdb_rating');


        if ($this->type !== 'all') {
            $query->where('type', $this->type);
        }

        return view('livewire.movie.movie-list', [
            'movies' => $query->paginate(50),
        ]);
    }
}
