<?php

namespace App\Repositories;

use App\Http\Resources\PostResource;
use App\Post;
use App\Repositories\Interfaces\PostsRepositoryInterface;

class PostsRepository extends BaseRepository implements PostsRepositoryInterface {
    /**
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }
    /**
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function paginated(int $perPage = 9) :\Illuminate\Http\JsonResponse {
        $posts = $this->model->with(['User','Category','Images'])->orderBy('id','desc')->paginate($perPage);
        return PostResource::collection($posts)->response();
    }
    /**
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function find(Post $post): ?\Illuminate\Http\JsonResponse
    {
       return (new PostResource($post->with(['User','Category','c'])))->response();
    }
    public function create(array $attributes): ?\Illuminate\Http\JsonResponse
    {
        $post = $this->model->create($attributes);
        $post->addImages();
        return (new PostResource($post))->response();
    }
    /**
     *
     * @param array $attributes
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function update(array $attributes, Post $post): ?\Illuminate\Http\JsonResponse
    {
        $post = $post->update($attributes);
        return (new PostResource($post))->response();
    }
    /**
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function delete(Post $post): ?\Illuminate\Http\JsonResponse
    {
        $post->delete();
        return response()->json(['message' => 'deleted']);
    }
}