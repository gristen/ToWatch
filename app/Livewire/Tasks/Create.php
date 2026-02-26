<?php

namespace App\Livewire\Tasks;

use App\Livewire\Forms\TaskForm;
use Livewire\Component;

class Create extends Component
{

    public TaskForm $form;




    public function store()
    {

       $task = $this->form->createTask();

        $this->dispatch('task-created', ['task' => $task]);
    }

    public function render()
    {
        return view('livewire.tasks.create');
    }
}
