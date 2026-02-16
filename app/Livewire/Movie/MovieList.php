<?php

namespace App\Livewire\Movie;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MovieList extends Component
{
    use WithPagination;

    public ?int $genre = null;
    public string $type = 'all';

    #[On('movie-closed')]
    public function updateMovieList()
    {

    }
    #[On('filter-changed')]
    public function applyFilter($genre = null)
    {

        $this->genre = $genre;
        $this->resetPage();

    }

    public function render()
    {

        $movies = Movie::query()
            ->when($this->genre,
                fn($query) => $query->whereHas('genres',
                fn($query) => $query->where('genre_id', $this->genre)))
            ->where('type', $this->type)
            ->with('countries','publisher')
            ->orderByDesc('imdb_rating')
            ->paginate(15);

        return view('livewire.movie.movie-list', [
            'movies' => $movies,
        ]);
    }
}
