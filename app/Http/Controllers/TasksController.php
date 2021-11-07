<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Task;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TasksController extends Controller
{
    public function index()
    {

        $tasks = Task::where('user_id', auth()->user()->id)
            ->orderBy('completed_at', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

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

    public function deleted(): View
    {
        $tasks = Task::where('user_id', auth()->user()->id)
            ->onlyTrashed()
            ->orderBy('completed_at', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('tasks.deleted', ['tasks' => $tasks]);
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->back();
    }

    public function restore(int $id): RedirectResponse
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->back();
    }
}
