<?php

namespace App\Repositories;

use App\Comment;
use App\Http\Resources\CommentResource;
use App\Post;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface {
    
    /**
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }
    /**
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function getPostComments(Post $post): JsonResponse
    {
        return CommentResource::collection($post->comments()->with(['user' => fn($q) => $q->with('Images')])->paginate(9))->response();
    }

    /**
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function show(Comment $comment): JsonResponse
    {
        return (new CommentResource($comment->load(['likers','user' => fn($q) => $q->with('Images')])->loadCount('likes')))->response();
    }

    /**
     *
     * @param array $attr
     * @return JsonResponse
     */
    public function store(array $attr): JsonResponse
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'body' => $attr['body'],
            'commentable_id' => $attr['post_id'],
            'commentable_type' => 'App\\Post'
        ]);
        return (new CommentResource($comment))->response();
    }
    
    /**
     *
     * @param array $attr
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(array $attr, Comment $comment): JsonResponse
    {
        $comment->update($attr);
        $comment = Comment::find($comment->id)->load(['likers','user' => fn($q) => $q->with('Images')])->loadCount('likes');
        return (new CommentResource($comment))->response();
    }

    /**
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function delete(Comment $comment): JsonResponse
    {
        $comment->delete();
        return response()->json('deleted');
    }
}