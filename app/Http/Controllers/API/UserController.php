<?php

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{

    public function register(UserRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->name = $request->input('email');
            $user->name = $request->input('mobile');
            $user->name = $request->input('password');
            $user->save();
            $user->sendEmailVerificationNotification();
            return response()->json(['ok' => 'true', 'message' => 'we have sent you an
            verification email, if you do not see it in your inbox, please check your spam']);
        } catch (Throwable $e) {
            return response()->json(['ok' => 'false', 'message' => $e->getMessage()]);
        }
    }


    public function login(LoginRequest $request)
    {
        $credentials = ['email'=>$request->input('email'),
            'password'=>$request->input('password')];
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}