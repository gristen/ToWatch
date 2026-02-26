<?php

namespace App\Livewire\Tasks;

use App\Livewire\Forms\TaskForm;
use Livewire\Attributes\On;
use Livewire\Component;

class Close extends Component
{
    public TaskForm $form;

    #[On('set-task-id')]
    public function setTaskId($id)
    {

        $this->form->id = $id;
    }


    public function closeTask()
    {
        $closedTask = $this->form->closeTask();

        $this->dispatch('task-closed', ['$closedTask' => $closedTask]);
    }

    public function render()
    {
        return view('livewire.tasks.close');
    }
}
