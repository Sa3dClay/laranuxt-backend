<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request) {
        // $this->validate($request, [
        //     'name'      => 'required',
        //     'password'  => 'required|min:8',
        //     'email'     => 'email|required|unique:users,email',
        // ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),

            // also can use Hash:make like below
            // 'password'  => Hash::make($request->password),
        ]);

        if(!$token = auth()->attempt($request->only(['email', 'password']))) {
            return abort(401);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function login(UserLoginRequest $request) {
        if(!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'error' => 'The email or password is incorrect, please make sure your data is right!'
            ], 401);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function user(Request $request) {
        $data = $request->user();
        // return gettype($data);
        return new UserResource($data);
    }

    public function logout() {
        auth()->logout();
    }
}
