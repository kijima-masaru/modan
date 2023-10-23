<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿作成機能
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

    // 投稿情報の取得
    public function getAllPosts()
    {
        $posts = Post::with('user')->get();

        return response()->json($posts->map(function($post) {
            return [
                'id' => $post->id,
                'username' => $post->user->name,
                'content' => $post->content,
            ];
        }));
    }

    // 投稿削除機能
    public function deletePost($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}