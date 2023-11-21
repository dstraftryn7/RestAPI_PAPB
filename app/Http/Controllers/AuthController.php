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
            'password' => $attrs['password']
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

     public function profile(Request $request)
    {
        $user = Auth::user();
        return response()->json(['user' => $user == null]);
    }


    //edit
    public function getUser()
    {
        // Mendapatkan data pengguna
        $user = User::first();

        return response()->json($user);
    }

    public function updateUser(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Mengambil data pengguna dari request
        $data = $request->only(['username', 'email', 'password']);

        // Menyimpan data pengguna ke database
        $user = User::first();
        $user->update($data);

        return response()->json(['message' => 'User updated successfully']);
    }

    public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($user);
}
}
