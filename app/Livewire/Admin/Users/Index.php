<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public string $search = '';
    public $handler;
    public function render($id)
    {
        $item = $this->hendler::table();

        debugbar()->info($item);

        $query = $this->handler::query()
        ->when($this->search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->search($search);
            });
        });

        return view('livewire.admin.users.index', [
            'users'=> User::with('role')->paginate(10)
        ]);
    }
}
