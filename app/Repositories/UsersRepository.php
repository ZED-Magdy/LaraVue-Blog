<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UsersRepositoryInterface;
use App\User;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface {
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(): \Illuminate\Http\JsonResponse
    {
        return UserResource::collection($this->model->all())->response();
    }

    /**
     *
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(\App\User $user): \Illuminate\Http\JsonResponse
    {
        return (new UserResource($user->load(['roles','Images','Posts'])))->response();
    }

    /**
     *
     * @param array $attributes
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
    */
   public function update(array $attributes, \App\User $user): \Illuminate\Http\JsonResponse
   {
       $user->update($attributes);
       return (new UserResource($user->load(['roles','Images','Posts'])))->response();
   }

   /**
    *
    * @param \App\User $user
    * @return \Illuminate\Http\JsonResponse
    */
   public function delete(\App\User $user): \Illuminate\Http\JsonResponse
   {
       //TODO: Ban User
       return response()->json('Not Impelemented, yet !');
   }
}