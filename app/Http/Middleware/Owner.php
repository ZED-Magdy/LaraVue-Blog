<?php

namespace App\Http\Middleware;

use Closure;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->route()->Parameters()[$request->route()->parameterNames[0]]->user_id != auth()->id()){
            return response()->json(['message' => 'You dont have permission to do this action.'],401);
        }
        return $next($request);
    }
}
