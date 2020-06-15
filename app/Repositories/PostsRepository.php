<?php

namespace App\Repositories;

use App\Http\Resources\PostResource;
use App\Post;
use App\Repositories\Interfaces\PostsRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
        $posts = $this->model->with(['User'=> fn($q) => $q->with('Images'),'Category','Images'])->orderBy('id','desc')->paginate($perPage);
        return PostResource::collection($posts)->response();
    }
    /**
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function find(Post $post): ?\Illuminate\Http\JsonResponse
    {
        return (new PostResource($post->load(['User','Category','Images'])))->response();
    }
    public function create(array $attributes): ?\Illuminate\Http\JsonResponse
    {
        $post = DB::transaction(function () use($attributes){
            $post = $this->model->create([
                'title' => $attributes['title'],
                'body' => $attributes['body'],
                'category_id'=> $attributes['category_id'],
                'user_id' => auth()->user()->id,
                'slug' => $attributes['slug']
            ]);
            $post->addImages("images",true);
            return $post;
        });
        return (new PostResource($post->load(['User','Category','Images'])))->response();
    }
    /**
     *
     * @param array $attributes
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function update(array $attributes, Post $post): ?\Illuminate\Http\JsonResponse
    {
        $post = DB::transaction(function () use($attributes,$post){
            $post->update($attributes);
            if($attributes['images_updated']) {
                $post->deleteImages();
                $post->addImages("images",true);
            }
            return $post;
        });
        return (new PostResource($post->load(['User','Category','Images'])))->response();
    }
    /**
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function delete(Post $post): ?\Illuminate\Http\JsonResponse
    {
        $post->deleteImages();
        $post->delete();
        return response()->json(['message' => 'deleted']);
    }
}