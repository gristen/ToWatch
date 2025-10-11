<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TaskCreate extends Component
{

    public TaskForm $form;

    public function store()
    {

       $task = $this->form->createTask();

        $this->dispatch('task-created', ['task' => $task]);
    }

    public function render()
    {
        return view('livewire.task-create');
    }
}
