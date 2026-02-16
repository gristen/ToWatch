<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component
{

    public  $about;

    #[On('remove-favorite')]
    public function removeFavorite(int $userId, int $movieId)
    {

        $user = User::query()->find($userId);
        $user->favoritesMovies()->detach($movieId);

        $this->dispatch('toast',
            type: 'success',
            message: 'Фильм удалён из избранного'
        );
    }

    public function render(?string $username = null)
    {


        if (Auth::user()) {

            $user = User::query()
                ->withCount(['followers', 'following','likesMovies','favoritesMovies','viewedMovies'])
                ->find(Auth::user()->id);

            return view('livewire.user.profile',compact('user'));
        }else{
            return abort(404);
        }

    }
}
