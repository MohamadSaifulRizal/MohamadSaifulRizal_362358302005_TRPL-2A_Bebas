<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    $request -> validate([
        'name' => 'required',
        'email'=> 'required|email|unique:users',
        'password'=> 'required|min:6',
        ]);
        $user = User::create([
            'name'=> $request -> name,
            'email'=> $request -> email,
            'password'=> Hash::make($request -> password),
        
        ]);
        $token = $user ->createToken('auth_token')->plainTextToken;
        return response()->json(['token'=> $token], 201);
        
    }

    public function login(Request $request){
    $request -> validate([
        'email'=> 'required',
        'password'=> 'required',
    ]);

    $user = User::where('email', $request -> email)->first();

    if ($user || !Hash::check($request -> password, $user ->password)) {
        return response()->json(['message'=> 'invalid'], 401);
    }

    $token = $user ->createToken('auth_token')->plainTextToken;
    
    return response()->json(['token'=> $token], 200);
    }

    public function logout(Request $request){
        
    }
}