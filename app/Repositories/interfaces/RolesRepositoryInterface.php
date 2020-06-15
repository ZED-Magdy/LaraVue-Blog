<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

interface RolesRepositoryInterface {

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
    public function find(Role $role) : JsonResponse;

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
    public function update(array $attributes, Role $role) : JsonResponse;

    /**
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(Role $role) : JsonResponse;
}