<?php

namespace App\Http\Controllers;

use App\Http\Repository\UserRepository;
use App\Http\Requests\PostUserRequest;
use App\Http\Resources\UserResponse;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\UpdateUserRequest;

class UserController extends BaseController
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->getAll();
    }

    public function show($id)
    {
        return $this->userRepository->find($id);
    }

    public function store(PostUserRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        return new UserResponse($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return $this->userRepository->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->userRepository->delete($id);
    }
}
