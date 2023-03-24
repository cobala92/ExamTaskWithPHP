<?php

namespace App\Http\Controllers;

use App\Http\Repository\TaskRepository;
use Illuminate\Http\Request;
use App\Http\Requests\PostTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{

    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request)
    {
        return $this->taskRepository->index($request);
    }

    public function show($id)
    {
        return $this->taskRepository->find($id);
    }

    public function store(PostTaskRequest $request)
    {
        return $this->taskRepository->create($request->all());
    }

    public function update(UpdateTaskRequest $request, string $id)
    {
        return $this->taskRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->taskRepository->delete($id);
    }

    public function getListTaskOfUser()
    {
        return $this->taskRepository->getListTaskOfUser();
    }

    public function getListTaskByUser(Request $request, $id)
    {
        return $this->taskRepository->getListTaskByUser($request, $id);
    }
}
