<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * function for view index task list
     *
     * @return view
     */
    public function index()
    {
        $tasks = Task::all();
        $editableTask = null;

        if (request('id') && request('action') == 'edit') {
            $editableTask = Task::find(request('id'));
        }

        return view('tasks.index', compact('tasks', 'editableTask'));
    }

    /**
     * function for store new task
     *
     * @return back view
     */
    public function store()
    {
        request()->validate([
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        Task::create(request()->only('name', 'description'));

        return back();
    }

    /**
     * function for update task by object
     *
     * @return back view
     */
    public function update(Task $task)
    {
        $taskData = request()->validate([
            'name'          => 'required|max:255',
            'description'   => 'required|max:255',
        ]);

        $task->update($taskData);

        return redirect('/tasks');
    }

    /**
     * function for delete task by object
     *
     * @return back view
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }
}
