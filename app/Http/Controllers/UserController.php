<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UsersRepositoryInterface;

class UserController extends Controller
{
    private $repo;

    public function __construct(UsersRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    public function datatable(){
        return $this->repo->datatable();
    }
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return $this->repo->all();
    }
    /**
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user){
        return $this->repo->find($user);
    }
    /**
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request,User $user){
        
        return $this->repo->update($request->only(['name','email']),$user);
    }
    /**
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user){
        return $this->repo->delete($user);
    }
}
