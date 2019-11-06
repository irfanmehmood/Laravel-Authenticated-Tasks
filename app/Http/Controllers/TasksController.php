<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** Import our Model Tasks  */
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        /* Using Eloquent Model */
        $tasks = Task::all();

        return view('examples.tasks.show', compact('tasks'));
    }

    public function showByEloquentModel()
    {
        /* Using Eloquent Model */
        $tasks = Task::all();

        return view('examples.tasks.show', compact('tasks'));
    }

    /** using Route Model Binding - Read my_read_me_md. 7.Route Model Binding */
    public function taskByEloquentModel(Task $task)
    {
        return view('examples.tasks.index', compact('task'));
    }

    public function taskByByQueryBuilder($task_id)
    {
        /* Using DB sql query builder */
        $task = \DB::table('tasks')->find($task_id);

        return view('examples.tasks.index', compact('task'));
    }

    public function showByQueryBuilder()
    {
        /* Using DB sql query builder */
        $tasks = \DB::table('tasks')->get();

        return view('examples.tasks.show', compact('tasks'));
    }
}
