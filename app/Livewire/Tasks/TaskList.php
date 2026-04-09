<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskList extends Component
{

    public Collection $tasksCompleted;

    public Collection $tasks; // запросы к DB вернут коллекцию моделей



    public ?string $type = null;


    public function mount(string $type)
    {
        $this->type = $type;

    }

    #[On('task-created')]
    public function updateTaskList($task): void
    {
        /*session()->flash('success', 'User created successfully');*/
    }

    #[On('task-closed')]
    public function updateClosedTaskList($task): void
    {

    }


    public function render()
    {

        $this->tasks = Task::query()->orderByRaw(
            "
            CASE urgency
                WHEN 'high' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'low' THEN 3
                ELSE 4
            END")

            ->when($this->type !== 'all', function ($query)  {
                $query->where('type', $this->type);
            })
            ->where('completed','!=', '1')
            ->get();



        $this->tasksCompleted = Task::query()->where('completed', '=', "1")->orderByDesc('id')->get();

        return view('livewire.tasks.list', ['tasks'=> $this->tasks]);
    }
}
