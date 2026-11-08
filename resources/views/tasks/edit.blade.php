@extends('layouts.tasks')

@section('title', 'Edit Task')

@section('content')
    <h1>Edit Task</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title</label>
            <input
                id="title"
                name="title"
                type="text"
                value="{{ old('title', $task->title) }}"
                required
            >
        </div>

        <div>
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option
                    value="pending"
                    @selected(old('status', $task->status) === 'pending')
                >
                    Pending
                </option>

                <option
                    value="in_progress"
                    @selected(old('status', $task->status) === 'in_progress')
                >
                    In Progress
                </option>

                <option
                    value="done"
                    @selected(old('status', $task->status) === 'done')
                >
                    Done
                </option>
            </select>
        </div>

        <div>
            <label for="task_date">Task Date</label>
            <input
                id="task_date"
                name="task_date"
                type="date"
                value="{{ old('task_date', $task->task_date->format('Y-m-d')) }}"
                required
            >
        </div>

        <button type="submit">Update Task</button>
    </form>
@endsection