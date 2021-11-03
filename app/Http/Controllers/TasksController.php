<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Task;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)
            ->orderBy('completed_at', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TasksRequest $request): RedirectResponse
    {
        $task = (new Task([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]));
        $task->user()->associate(auth()->user());
        $task->save();

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
