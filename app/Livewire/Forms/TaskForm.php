<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;
use Livewire\Attributes\On;

class TaskForm extends Form
{
    public $id;

    #[Validate('required')]
    public string $title;

    public string $description;

    public $urgency;

    public $difficulty;

    public string $comment = '' ;

    public string $link_git = '';

    public function closeTask()
    {


        $task = Task::query()->find($this->id);
        $task->update([
            'comment' => $this->comment,
            'link_git' => $this->link_git,
            'completed' => '1',

        ]);

        $this->reset('comment', 'link_git');

        return $task;
    }

    public function createTask()
    {
        $this->validate();
        $task = Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'urgency' => $this->urgency,
            'difficulty' => $this->difficulty,
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'User created successfully');
        return $task;

    }
}
