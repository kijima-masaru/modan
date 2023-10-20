<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'firebase_uid' => 'required|string|exists:users,firebase_uid',
        ]);

        $user = User::where('firebase_uid', $request->firebase_uid)->first();
        if (!$user) {
            return response()->json(['error' => 'ユーザーが見つかりません。'], 404);
        }

        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $user->id;
        $post->save();

        return response()->json(['message' => '投稿が保存されました。'], 201);
    }
}

