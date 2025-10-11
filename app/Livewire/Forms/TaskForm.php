<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    #[Validate('required')]
    public string $title;

    public string $description;

    public $urgency;

    public $difficulty;


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
