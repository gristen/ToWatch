<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show()
    {

        $tasks = Task::query()->orderByRaw(
            "
            CASE urgency
                WHEN 'high' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'low' THEN 3
                ELSE 4
            END")->where('completed','!=', '1')->get();


        $tasksCompleted = Task::query()->where('completed', '=', "1")->orderByDesc('id')->get();

        return view('tasks', ['tasks' => $tasks, 'tasksCompleted' => $tasksCompleted]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'urgency' => 'required|in:low,medium,high',
            'difficulty' => 'required|in:low,medium,high',
        ]);


            $task = Task::create([
                ...$data,
                'user_id' => Auth::id(),
            ]);


         return redirect()->route('tasks.show', $task);
    }


    public function update(Task $task, UpdateTaskRequest $request)
    {

        $task->update(
            [
                ...$request->validated(),
                'completed' => '1',
            ]

        );

        return redirect()->back();
    }


}
