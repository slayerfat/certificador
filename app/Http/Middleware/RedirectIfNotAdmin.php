<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Flash;
use Redirect;

class RedirectIfNotAdmin
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
        if (!Auth::user()->admin) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::route('home.index');
        }

        return $next($request);
    }
}
