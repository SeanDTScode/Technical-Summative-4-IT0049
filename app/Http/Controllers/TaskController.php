<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('is_archived', false)
            ->orderBy('task_date')
            ->orderBy('id')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:150'],
            'status'    => ['required', 'in:pending,in_progress,done'],
            'task_date' => ['required', 'date'],
        ]);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        abort_if($task->is_archived, 404);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        abort_if($task->is_archived, 404);

        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:150'],
            'status'    => ['required', 'in:pending,in_progress,done'],
            'task_date' => ['required', 'date'],
        ]);

        $wasAlreadyDone = $task->status === 'done';

        $task->update($validated);

        if (!$wasAlreadyDone && $task->status === 'done') {
            Mail::to(config('tasks.completion_recipient'))
                ->send(new TaskCompleted($task));
        }

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->update([
            'is_archived' => true,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task archived successfully.');
    }
}