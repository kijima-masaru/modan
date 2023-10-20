<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request)
    {
        Log::info('Register API called');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'uid' => 'required|string|unique:users,firebase_uid',  // Firebase UIDの検証を追加
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->firebase_uid = $request->uid;  // Firebase UIDを保存
        $user->save();

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user
        ], 201);
    }
}