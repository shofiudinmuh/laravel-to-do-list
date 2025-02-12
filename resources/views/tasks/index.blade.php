<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-DO List</title>
</head>

<body>
    @if (@session('success'))
    <div style="color: green">
        {{ session('success') }}
    </div>

    <div class="flex">
        <div class="col">
            @endif
            <h1>To-Do-List</h1>
            <form action="{{ route('task.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="New Task" required>
                <button type="submit">Add Task</button>
            </form>
        </div>
        <div class="col">
            <form action="{{ route('task.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>



    <ul>
        @foreach ($tasks as $task)
        <li>
            <form action="{{ route('task.update', $task->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' :
                '' }}>
                {{ $task->name }}
            </form>
            <form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
        @endforeach
        <div class="flex">{{ $tasks->links() }}</div>
    </ul>
</body>

</html>