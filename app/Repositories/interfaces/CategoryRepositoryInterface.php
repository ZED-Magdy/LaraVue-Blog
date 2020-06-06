<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;
use App\Category;
interface CategoryRepositoryInterface {

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
    public function find(Category $category) : JsonResponse;

    /**
     *
     * @param array $attributes
     * @return JsonResponse
     */
    public function create(array $attributes) : JsonResponse;

    /**
     *
     * @param array $attributes
     * @return Model|null
     */
    public function update(array $attributes, Category $category) : JsonResponse;

    /**
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(Category $category) : JsonResponse;
}