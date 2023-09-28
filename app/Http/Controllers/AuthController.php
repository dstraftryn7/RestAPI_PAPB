<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Register User
    public function register(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $attrs['name'],
            'email'=> $attrs['email'],
            'password' => bcrypt($attrs['password'])
        ]);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    // login user
    public function login(Request $request)
    {
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(!Auth::attempt($attrs))
        {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        return response([
            'user' => auth()->user(),
            'token'=>auth()->user()->createToken('token-name', ['server:update'])->plainTextToken,
        ], 200);
    }

    // logout user
    public function logout()
    {
     auth()->user()->tokens()->delete();
     return response([
        'message' => 'Logout Success.'
     ], 200);
    }
}
