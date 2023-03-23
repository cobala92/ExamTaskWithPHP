<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUserRequest;
use App\Models\User;
use App\Http\Resources\UserResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateUserRequest;

class UserController extends BaseController
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function store(PostUserRequest $request)
    {
        return new UserResponse(User::create($request->all()));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return User::where('id', $id)->update(request()->all());
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->first()) {
            return $user->delete();
        } else {
            return Response::json([
                'data' => 'User not found'
            ], 404);
        }
    }
}
