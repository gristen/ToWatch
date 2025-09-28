<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show()
    {
        $tasks = Task::query()->get();

        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title'=>'string|required',
            'description'=>'string|required',
            'urgency'=>'string|required',
            'difficulty'=>'string|required',
            'completed'=> 'integer|required',
        ]);



       $task = Task::query()->create($data);

       return redirect()->route('tasks.show', ['message' => 'Task created successfully']);
    }
}
