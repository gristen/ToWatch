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

    public function updated($name, $value): void
    {
        dump($name, $value);
        $this->dispatch(
            'filter-changed',
            $value,
        );
    }

    public function render()
    {
        $genres = Genre::all();
        return view('livewire.movie.movie-filter', ['genres' => $genres]);
    }

}
