@extends('layouts.app')

@section('content')
<h1 class="page-header text-center">Tasks Management</h1>
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <h2>Tasks</h2>
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item">
                    <a
                        href="{{ url('tasks') }}?action=edit&id={{ $task->id }}"
                        id="edit_task_{{ $task->id }}"
                        class="pull-right">
                        edit
                    </a>
                    {{ $task->name }} <br/>
                    {{ $task->description }}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-4">
        <h2>New Task</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('tasks') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="control-label">Name</label>
                <input id="name" class="form-control" type="text" name="name">
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Description</label>
                <textarea id="description" class="form-control" name="description"></textarea>
            </div>

            <input type="submit" value="Create Task" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection