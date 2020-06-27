<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Post;
use App\User;
use Overtrue\LaravelLike\Like;

class DashboardController extends Controller
{
    public function postsCount(){
        return response()->json(Post::count());
    }
    public function usersCount(){
        return response()->json(User::count());
    }
    public function commentsCount(){
        return response()->json(Comment::count());
    }
    public function likesCount(){
        return response()->json(Like::count());
    }
    public function posts(){
        return response()->json(PostResource::collection(Post::latest()->limit(8)->with('User')->get()));
    }
    public function comments(){
        return response()->json(CommentResource::collection(Comment::latest()->limit(15)->with('user')->get()));
    }
}
