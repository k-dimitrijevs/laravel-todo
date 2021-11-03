<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        return view('tasks.index', ['tasks' => Task::all()]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TasksRequest $request): RedirectResponse
    {
        (new Task([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]))->save();

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(TasksRequest $request, Task $task): RedirectResponse
    {
        $task->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function complete(Task $task): RedirectResponse
    {
        $task->toggleComplete();
        $task->save();
        return redirect()->back();
    }
}
