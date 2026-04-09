<?php

namespace App\Livewire\Tasks;

use App\Livewire\Forms\TaskForm;
use Livewire\Component;

class Create extends Component
{

    public TaskForm $form;

    public string $type = '';

    public function mount()
    {
        $this->form->type = $this->type;

    }
    public function store()
    {
        debugbar()->info($this->form->type);

        $task = $this->form->createTask();
        debugbar()->info($task);
        $this->dispatch('task-created', ['task' => $task]);
    }

    public function render()
    {

        return view('livewire.tasks.create');
    }
}
