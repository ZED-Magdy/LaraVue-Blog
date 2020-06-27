<?php

namespace App\Repositories\Interfaces;

use App\Comment;
use App\Post;
use Illuminate\Http\JsonResponse;

interface CommentRepositoryInterface {

    /**
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function getPostComments(Post $post) : JsonResponse;

    /**
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function show(Comment $comment) : JsonResponse;

    /**
     *
     * @param array $attr
     * @return JsonResponse
     */
    public function store(array $attr) : JsonResponse;

    /**
     *
     * @param array $attr
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(array $attr, Comment $comment) : JsonResponse;

    /**
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function delete(Comment $comment) : JsonResponse;
}