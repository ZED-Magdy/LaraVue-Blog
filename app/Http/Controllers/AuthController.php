<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\storeRequest;
use App\Repositories\Interfaces\ApiAuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     *
     * @var ApiAuthRepositoryInterface
     */
    private $repo;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(ApiAuthRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    /**
     *
     * @param storeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(storeRequest $request){
        return $this->repo->register($request->only(['email','name','password']));
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return $this->repo->login($request->only(['email','password']));
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->repo->authUser();
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->repo->logout();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->repo->refreshToken();
    }
}
