<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Completed</title>
</head>
<body>
    <h1>Task Completed</h1>

    <p>The following task was marked as done:</p>

    <p>
        <strong>Title:</strong>
        {{ $task->title }}
    </p>

    <p>
        <strong>Task date:</strong>
        {{ $task->task_date->format('F j, Y') }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ ucfirst($task->status) }}
    </p>
</body>
</html>