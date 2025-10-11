<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskForm;
use Livewire\Component;
use Livewire\Attributes\On;
class ClosedTask extends Component
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
        return view('livewire.closed-task');
    }
}
