<?php

namespace App\Repositories\Interfaces;

use App\Post;
use Illuminate\Http\JsonResponse;

interface PostsRepositoryInterface {

    /**
     *
     * @param integer $perPage
     * @return JsonResponse
     */
    public function paginated(int $perPage = 9) : JsonResponse;
    /**
     *
     * @param int $id
     * @return JsonResponse|null
     */
    public function find(Post $post) : ?JsonResponse;
    /**
     *
     * @param array $attributes
     * @return JsonResponse|null
     */
    public function create(array $attributes) : ?JsonResponse;
    /**
     *
     * @param array $attributes
     * @param integer $id
     * @return JsonResponse|null
     */
    public function update(array $attributes,Post $post) : ?JsonResponse;
    /**
     *
     * @param integer $id
     * @return JsonResponse|null
     */
    public function delete(Post $post) : ?JsonResponse;
}