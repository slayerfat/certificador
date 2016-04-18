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
        $id = $request->route('userID') ?
            $request->route('userID') : $request->route('id');

        if (!Auth::user()->isOwnerOrAdmin($id)) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::back();
        }

        return $next($request);
    }
}
