<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        \Log::info("Request Data:", $request->all());

        // FirebaseのUIDからusersテーブルの対応するレコードを検索
        $user = User::where('firebase_uid', $request->firebase_uid)->first();

       // ユーザーが存在しない場合はエラーレスポンスを返す
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // 投稿内容を保存
        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $user->id;
        $post->save();

        return response()->json(['message' => 'Post created successfully'], 200);
    }
}