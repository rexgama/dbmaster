<?php

namespace Rexgama\DBMaster\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->can('access-dbmaster')) {
            abort(403, 'Unauthorized access to DBMaster.');
        }

        return $next($request);
    }
}