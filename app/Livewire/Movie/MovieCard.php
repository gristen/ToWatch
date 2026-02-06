<?php

namespace App\Livewire\Movie;

use App\Models\Movie;
use Livewire\Attributes\On;
use Livewire\Component;

class MovieCard extends Component
{
    public Movie $movie;
    public string $mode;
    public $userId;


    public function mount(Movie $movie, string $mode, $userId)
    {
        $this->movie = $movie;
        $this->mode = $mode;
        $this->userId = $userId;
    }

    public function render()
    {
        return view('livewire.movie-card');
    }
}
