<?php

namespace App\Repositories;

use App\Http\Resources\RoleResource;
use App\Repositories\Interfaces\RolesRepositoryInterface;
use Spatie\Permission\Models\Role;

class RolesRepository extends BaseRepository implements RolesRepositoryInterface {

    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(): \Illuminate\Http\JsonResponse
    {
        return RoleResource::collection($this->model->all())->response();
    }

    /**
     *
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(Role $role): \Illuminate\Http\JsonResponse
    {
        return (new RoleResource($role))->response();
    }

    /**
     *
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(array $attributes): \Illuminate\Http\JsonResponse
    {
        $role = $this->model->create($attributes);
        return (new RoleResource($role))->response();
    }

    /**
     *
     * @param array $attributes
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $attributes, Role $role): \Illuminate\Http\JsonResponse
    {
        $this->model->update($attributes);
        return (new RoleResource($role))->response();
    }

    public function delete(Role $role): \Illuminate\Http\JsonResponse
    {
        $role->delete();
        return response()->json('deleted');
    }
}