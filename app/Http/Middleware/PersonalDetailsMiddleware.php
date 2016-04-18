<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Flash;
use Redirect;

class PersonalDetailsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->isOwnerOrAdmin($request->route('userID'))) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::back();
        }

        return $next($request);
    }
}
