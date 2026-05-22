<?php

namespace App\Livewire\User;

use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

use Livewire\Component;
use Livewire\WithFileUploads;
class Profile extends Component
{
    use WithFileUploads;

    public $value;
    public $about;

    public $avatar;

    public $previewAvatar;

    public $user;

    public function mount($value = null)
    {
        $this->value = $value;

        $this->user = User::query()
            ->withCount(['followers', 'following', 'likesMovies', 'favoritesMovies', 'viewedMovies'])
            ->when(is_numeric($value), function ($query) use ($value) {
              $query->where('id', $value);
            })
            ->when(!is_numeric($this->value), function ($query) {
                $query->where('name', $this->value);
            })->firstOrFail();

    }
    public function saveProfile()
    {

        if ($this->previewAvatar){

            //удалить старый аватар
            if ($this->user->avatar && file_exists(public_path('storage/' . $this->user->avatar))){
                Storage::disk('public')->delete($this->user->avatar);
            }

            $path = $this->previewAvatar->store('avatars', 'public');

            $this->user->avatar = $path;
        }

        $this->user->update([
            'about' => $this->about,
            'avatar' => $this->avatar,
        ]);

        $this->reset('previewAvatar');

        $this->dispatch('profile-updated',
            type: 'success',
            message: 'Профиль обновлен'
        );
    }

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

    public function render()
    {

        return view('livewire.user.profile', [
            'user' => $this->user,
        ]);


    }
}
