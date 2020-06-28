<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function getPostLikes(Post $post){
        $likes = $post->likers()->get();
        return response()->json($likes);
    }
    public function toggleLike(Post $post){
        $like = auth()->user()->toggleLike($post);
        return response()->json(["like_status" => (auth()->user()->hasLiked($post) ? "liked" : "unliked")]);
    }
}
