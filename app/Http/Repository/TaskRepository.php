<?php

namespace App\Http\Repository;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Task;

class TaskRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\Models\Task::class;
    }


    public function index(Request $request)
    {
        $task = Task::query();
        if ($request->has('title')) {
            $task->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->has('status')) {
            $task->where('status', 'LIKE', '%' . $request->status . '%');
        }
        return  $task->get();
    }


    public function getListTaskOfUser()
    {
        return User::with('tasks')->get();
    }

    public function getListTaskByUser(Request $request, $id)
    {
        return Task::select('tasks.*')
            ->join('users', 'users.id', 'assignee')
            ->where('users.id', $id)
            ->where(function ($q) use ($request) {
                if ($request->has('title')) {
                    $q->where('title', 'LIKE', '%' . $request->title . '%');
                }
                if ($request->has('description')) {
                    $q->where('description', 'LIKE', '%' . $request->description . '%');
                }
                if ($request->has('status')) {
                    $q->where('status', $request->status);
                }
            })->get();
    }
}
