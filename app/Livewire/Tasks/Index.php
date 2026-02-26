<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;

class Index extends Component
{
    public array $types = [];
    public array $counters = [];

    public function mount()
    {

        $this->counters = Task::query()
            ->selectRaw("type, COUNT(*) as total")
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();
    }


    public function render()
    {

        return view('livewire.tasks.index');
    }
}
