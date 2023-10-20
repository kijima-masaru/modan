<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = Like::where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();

        if (!$like) {
            $like = new Like;
            $like->user_id = $request->user_id;
            $like->post_id = $request->post_id;
            $like->save();
        }

        return response()->json(['message' => 'いいねしました']);
    }

    public function destroy(Request $request)
    {
        $like = Like::where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['message' => 'いいねを解除しました']);
    }
}
