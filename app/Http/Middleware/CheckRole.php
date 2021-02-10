<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $role)
    {
        $roles = [
            'admin' => [1],
            'user' => [2],
        ];

        if(!in_array(auth()->user()->status, $roles[$role])){
            abort(403);
        }

        return $next($request);
    }
}
