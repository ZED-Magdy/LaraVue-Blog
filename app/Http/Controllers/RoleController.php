<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\AssignRequest;
use App\Http\Requests\Role\RemoveRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\Interfaces\RolesRepositoryInterface;

class RoleController extends Controller
{
    private $repo;

    public function __construct(RolesRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    public function datatable(){
        return $this->repo->datatable();
    }
    /**
     *
     * @return JsonResponse;
     */
    public function index(){
        return $this->repo->all();
    }
    /**
     *
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role){
        return $this->repo->find($role);
    }
    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request){
        return $this->repo->create($request->only(['name']));
    }
    /**
     *
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Role $role){
        return $this->repo->update($request->only(['name']),$role);
    }
    /**
     *
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role){
        return $this->repo->delete($role);
    }
    /**
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignRole(AssignRequest $request, User $user){
        $role = Role::findById($request->role,'api');
        if(!$role){
            return response()->json(['message' => 'role not found'],404);
        }
        if($user->hasRole($role)){
           return response()->json(['message' => 'user already has this role'],401); 
        }
        $user->assignRole($role);
        return response()->json(['message' => $user->name.' now has '.$role->name.' role']);
    }
    /**
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeRole(RemoveRequest $request, User $user){
        $role = Role::findById($request->role,'api');
        if(!$role){
            return response()->json(['message' => 'role not found'],404);
        }
        if(!$user->hasRole($role)){
           return response()->json(['message' => 'user already doesnt has this role'],401); 
        }
        $user->removeRole($role);
        return response()->json(['message' => $role->name.' has been removed from '.$user->name]);
    }
}
