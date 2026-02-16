<?php

namespace App\Livewire\User;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FavoriteGenres extends Component
{
    public User $user;
    public Collection $genres;

    public string $about;
    public array $selected = [];

    public function mount()
    {
       $this->user = auth()->user();

        $this->genres = Genre::orderBy('name')->get();

        $this->selected = $this->user
            ->favoriteGenres()
            ->pluck('genres.id')
            ->toArray();
    }

    public function saveProfile()
    {
        $this->user->update(['about' => $this->about,
        ]);
        $this->dispatch('profile-updated',
            type: 'success',
            message: 'Профиль обновлен'
        );
    }

    public function toggle(int $genreId):void
    {


        if (in_array($genreId, $this->selected)) {
            $this->user->favoriteGenres()->detach($genreId);
            $this->selected = array_diff($this->selected, [$genreId]);
        } else {
            $this->user->favoriteGenres()->attach($genreId);
            $this->selected[] = $genreId;
        }

        $this->dispatch('toast',
            type: 'success',
            message: 'Жанры обновлены'
        );
    }

    public function render()
    {
        return view('livewire.user.favorite-genres');
    }
}


