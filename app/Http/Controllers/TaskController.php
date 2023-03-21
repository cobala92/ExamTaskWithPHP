<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $task = Task::query();
        if($request -> has('title')){
            $task-> where('title', 'LIKE', '%'.$request->title.'%');
        }
        if($request->has('status')){
            $task-> where('status', 'LIKE', '%'.$request->status.'%');
        }
        return  $task->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'status' => 'required',
            'status.*' => Rule::in([0, 1]),
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        }
        $data = $request->all();
        $data['assignee'] = User::first()->id;
        return Task::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Task::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return Task::find($id)->update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'numbers' => $request->numbers,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'actual' => $request->actual,
            ],
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Task::find($id)->delete();
    }
}
