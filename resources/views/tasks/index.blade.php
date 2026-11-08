@extends('layouts.tasks')

@section('title', 'Task List')

@section('content')
    <h1>Task List</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @auth
        <p>
            <a href="{{ route('tasks.create') }}">Create Task</a>
        </p>
    @endauth

    @if ($tasks->isEmpty())
        <p>No tasks found.</p>
    @else
        <table border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Task Date</th>

                    @auth
                        <th>Actions</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->task_date->format('Y-m-d') }}</td>

                        @auth
                            <td>
                                <a href="{{ route('tasks.edit', $task) }}">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('tasks.destroy', $task) }}"
                                    style="display:inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Archive this task?')"
                                    >
                                        Archive
                                    </button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection