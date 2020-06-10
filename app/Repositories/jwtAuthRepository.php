<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\ApiAuthRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class jwtAuthRepository implements ApiAuthRepositoryInterface {

    /**
     *
     * @param array $credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(array $credentials): \Illuminate\Http\JsonResponse
    {
        $user = DB::transaction(function () use($credentials) {
            $user = User::create([
                "email" => $credentials['email'],
                'name' => $credentials['name'],
                'password' => Hash::make($credentials['password'])
            ]);
            $role = Role::where('name','user')->first();
            $user->assignRole($role);
            $user->addImages("image",false);
            return $user;
        });
        return (new UserResource($user->load('Images')))->response();
    }
    
    /**
     *
     * @param array $credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(array $credentials): \Illuminate\Http\JsonResponse
    {
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authUser(): \Illuminate\Http\JsonResponse
    {
        return (new UserResource($this->guard()->user()->load(['Images','roles'])))->response();
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

        /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}