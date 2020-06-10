<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;

interface ApiAuthRepositoryInterface {

    /**
     *
    * @param array $credentials
    * @return JsonResponse
    */
    public function login(array $credentials) : JsonResponse;
    
    /**
     *
     * @param array $credentials
     * @return JsonResponse
     */
    public function register(array $credentials) : JsonResponse;

    /**
     *
     * @return JsonResponse
     */
    public function authUser() : JsonResponse;

    /**
     *
     * @return JsonResponse
     */
    public function refreshToken() : JsonResponse;
    
    /**
     *
     * @return JsonResponse
     */
    public function logout() : JsonResponse;
}