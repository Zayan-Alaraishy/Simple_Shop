<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        $user = Auth::user();

        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                return $next($request);
            }
        }

        return abort(403, 'Unauthorized');
    }
}