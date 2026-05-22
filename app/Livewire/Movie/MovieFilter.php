<?php

namespace App\Livewire\Movie;

use App\Models\Genre;
use App\Models\Movie;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MovieFilter extends Component
{
    use WithPagination;

    #[Url]
    public ?int $genre = null;
    #[Url]
    public ?int $year = null;
    #[Url]
    public ?int $rating = null;
    public $search;
    public $minYear;
    public $maxYear;

    public function updatedGenre($value): void
    {

        $this->dispatch(
            'genre-changed',
            $value,
        );
    }

    public function mount()
    {
        $this->minYear = Movie::query()->min('year');
        $this->maxYear = Movie::query()->max('year');
    }

    public function render()
    {

        $movies = Movie::query()->when($this->search, function ($q, $search) {
            $q->search($search, ['name', 'eng_name']);
        })->take(5)->get();

        $genres = Genre::all();
        return view('livewire.movie.movie-filter', ['genres' => $genres, 'movie' => $movies]);
    }

}
