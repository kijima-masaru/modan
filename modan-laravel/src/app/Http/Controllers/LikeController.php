<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request)
{
    $firebaseUid = $request->input('userId');
    $postId = $request->input('postId');

    $user = User::where('firebase_uid', $firebaseUid)->first();

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }

    $like = new Like();
    $like->user_id = $user->id;
    $like->post_id = $postId;
    $like->save();

    return response()->json(['success' => true]);
}
}

