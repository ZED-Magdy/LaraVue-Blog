<?php

namespace App\Repositories\Interfaces;

use App\User;
use Illuminate\Http\JsonResponse;
interface UsersRepositoryInterface {

    /**
     *
     * @return JsonResponse
     */
    public function all() : JsonResponse;

    /**
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function find(User $user) : JsonResponse;

    /**
     *
     * @param array $attributes
     * @return Model|null
     */
    public function update(array $attributes, User $user) : JsonResponse;

    /**
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(User $user) : JsonResponse;
}