<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks Management</title>
</head>
<body>
    <form action="{{ url('tasks') }}" method="post">
        {{ csrf_field() }}
        <input type="text" name="name">
        <textarea name="description"></textarea>
        <input type="submit" value="Create Task">
    </form>
    <h1>Tasks Management</h1>
    <ul>
        @foreach($tasks as $task)
            <li>
                {{ $task->name }} <br/>
                {{ $task->description }}
            </li>
        @endforeach
    </ul>
</body>
</html>