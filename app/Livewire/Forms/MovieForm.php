<?php

namespace App\Livewire\Forms;

use App\Models\Movie;
use App\Models\Task;
use Livewire\Component;
use Livewire\Form;

class MovieForm extends Form
{
    public $id;

    /*delete movie from database */
    /*TODO rename method*/
    public function closeMovie()
    {
        $movie = Movie::query()->find($this->id);

        $movie->countries()->detach();
        $movie->genres()->detach();
        $movie->persons()->detach();
        $movie->fees()->delete();
        $movie->delete();

    }
    /*delete from favorites movie in user profile*/


}
