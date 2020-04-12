<?php

namespace App\Http\Middleware;

use Closure;

class isBanned
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
        if (auth()->user() && auth()->user()->is_banned == 1) {
            return $next($request);
        }
        return  abort(403, 'Доступ запрещен');
    }
}
