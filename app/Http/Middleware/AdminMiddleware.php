<?php


namespace App\Http\Middleware;

use App\Http\Enums\RoleUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $role_id = Auth::guard($guard)->user()->roles->first()->id;
        if (!(isset($role_id) && intval($role_id) == RoleUser::Admin)) {
            return response()->json("You are not Admin");
            //return route('login');
        }
        return $next($request);
    }
}
