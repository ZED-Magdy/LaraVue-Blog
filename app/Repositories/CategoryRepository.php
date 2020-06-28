<?php

namespace App\Repositories;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {
    
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(): \Illuminate\Http\JsonResponse
    {
        $categories = $this->model->all();
        return CategoryResource::collection($categories)->response();
    }
    /**
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(\App\Category $category): \Illuminate\Http\JsonResponse
    {
        return (new CategoryResource($category->load(['Posts' => fn($q) => $q->with(['User'])])))->response();
    }
    /**
     *
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(array $attributes): \Illuminate\Http\JsonResponse
    {
        $category = $this->model->create($attributes);
        return (new CategoryResource($category))->response();
    }
    /**
     *
     * @param array $attributes
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $attributes, \App\Category $category): \Illuminate\Http\JsonResponse
    {
        $updated = $category->update($attributes);
        return (new CategoryResource($updated))->response();
    }
    /**
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(\App\Category $category): \Illuminate\Http\JsonResponse
    {
       $category->delete();
       return response()->json(['message' => 'deleted']);
    }
}