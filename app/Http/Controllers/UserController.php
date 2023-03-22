<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        }
        return new UserResponse(User::create($request->all()));
    }

    public function update(Request $request, $id)
    {
        return User::find($id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ],
        );
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
