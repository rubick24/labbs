<?php

namespace App\Http\Middleware;

use App\Article;
use Closure;

class CheckPermission
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
        if (\Auth::id() == Article::find($request->input('id'))->user_id||\Auth::user()->hasRole('owner')||\Auth::user()->hasRole('admin')) {
            return $next($request);

        }

        return abort(403);
    }
}
